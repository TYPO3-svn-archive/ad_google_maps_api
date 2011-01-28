<?php
/***************************************************************
 *  Copyright notice
 *
 *  (c) 2010 Arno Dudek <webmaster@adgrafik.at>
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 2 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

/**
 * The TCA service MapDrawer. 
 *
 * @package Extbase
 * @subpackage GoogleMapsApi\Service\MapDrawer
 * @scope prototype
 * @entity
 * @api
 */
class tx_AdGoogleMapsApi_Service_MapDrawer {

	const TEMPLATE_FILE = 'EXT:ad_google_maps_api/Resources/Private/Templates/Service/MapDrawer/index.html';

	/**
	 * @var array
	 */
	protected static $supportedLayerTypes = array(
		'tx_adgooglemapsapi_layers_marker',
		'tx_adgooglemapsapi_layers_polyline',
		'tx_adgooglemapsapi_layers_polygon',
	);

	/**
	 * @var array
	 */
	protected $settings;

	/**
	 * @var Tx_Fluid_View_TemplateView
	 */
	protected $view;

	/**
	 * @var array
	 */
	protected $currentField;

	/**
	 * @var t3lib_TCEforms
	 */
	protected $formObject;


	/**
	 * Initializes the current action
	 *
	 * @return void
	 */
	public function initialize() {
		$configurationManager = t3lib_div::makeInstance('Tx_Extbase_Configuration_BackendConfigurationManager');
		if (method_exists($configurationManager, 'loadTypoScriptSetup')) { // extbase < 1.3.0beta1
			$typoScriptSetup = Tx_Extbase_Utility_TypoScript::convertTypoScriptArrayToPlainArray($configurationManager->loadTypoScriptSetup());
		} else if (method_exists($configurationManager, 'getTypoScriptSetup')) { // extbase >= 1.3.0beta1
			$typoScriptSetup = Tx_Extbase_Utility_TypoScript::convertTypoScriptArrayToPlainArray($configurationManager->getTypoScriptSetup());
		}
		$this->settings = $typoScriptSetup['plugin']['tx_adgooglemapsapi']['settings'];
	}

	/**
	 * User function for Google Maps database fields. 
	 *
	 * @param array $currentField
	 * @param t3lib_TCEforms $formObject
	 * @return void
	 */
	public function user_parseCoordinatesField($currentField, $formObject) {
		$this->initialize();

		if (!is_array($this->settings) || !array_key_exists('mapDrawer', $this->settings)) {
			$message = t3lib_div::makeInstance('t3lib_FlashMessage', 'Add static TypoScript "ad: Google Maps" to your template.', t3lib_FlashMessage::ERROR);
			t3lib_FlashMessageQueue::addMessage($message);
			return;
		}

		// Initialize view object.
		$controllerContext = t3lib_div::makeInstance('Tx_Extbase_MVC_Controller_ControllerContext');
		$controllerContext->setRequest(t3lib_div::makeInstance('Tx_Extbase_MVC_Request'));
		$this->view = t3lib_div::makeInstance('Tx_Fluid_View_TemplateView');
		$this->view->setControllerContext($controllerContext);
		$this->view->setTemplatePathAndFilename(t3lib_div::getFileAbsFileName(self::TEMPLATE_FILE));
		// Add Google Maps API
		$GLOBALS['TBE_TEMPLATE']->getPageRenderer()->addJsFile($this->getGoogleMapsApiUrl(), 'text/javascript', false);
		// Add JavaScript Class to form.
		$javaScriptClass = str_replace(PATH_site, '', t3lib_div::getFileAbsFileName($this->settings['mapDrawer']['pluginUrl']));
		$formObject->loadJavascriptLib($javaScriptClass);

		// Check table configuration.
		if (!array_key_exists($currentField['table'], $this->settings['mapDrawer']['mapping'])) {
			$message = t3lib_div::makeInstance('t3lib_FlashMessage', 'MapDrawer found no configuration for current table "' . $currentField['table'] . '".<br />See: plugin.tx_adgooglemapsapi.settings.mapDrawer.mapping.*', 'tx_adgooglemapsapi: Invalid plugin configuration', t3lib_FlashMessage::ERROR);
			t3lib_FlashMessageQueue::addMessage($message);
			return;
		}
		$tableSettings = $this->settings['mapDrawer']['mapping'][$currentField['table']];

		$center = '48.209206,16.372778';

		// Check map center.
		$center = trim($this->settings['api']['center']);
		if (Tx_AdGoogleMapsApi_LatLng::isValidCoordinate($center) === FALSE) {
			$message = t3lib_div::makeInstance('t3lib_FlashMessage', 'Given map center "' . $center . '" is invalid. The format must be like "48.209206,16.372778".<br />See: plugin.tx_adgooglemapsapi.settings.api.center', 'tx_adgooglemapsapi: Invalid plugin configuration', t3lib_FlashMessage::ERROR);
			t3lib_FlashMessageQueue::addMessage($message);
			return;
		}

		// Get Google Maps layer type.
		// If type is not a Google Maps layer type, then it must be a database field. Only database fields are supported to create markers out of a shape layer.
		$layerType = $tableSettings['fieldNames']['type'];
		if (in_array($layerType, self::$supportedLayerTypes) === FALSE) {
			// If database field found take value else show error.
			if (array_key_exists($tableSettings['fieldNames']['type'], $currentField['row'])) {
				$layerType = $currentField['row'][$tableSettings['fieldNames']['type']];
			} else {
				$message = t3lib_div::makeInstance('t3lib_FlashMessage', 'Given type "' . $tableSettings['fieldNames']['type'] . '" must be a database field name or a Google Maps type of "' . implode('", "', self::$supportedLayerTypes) . '".<br />See: plugin.tx_adgooglemapsapi.settings.mapDrawer.mapping.' . $currentField['table'] . '.type', 'tx_adgooglemapsapi: Invalid extension configuration', t3lib_FlashMessage::ERROR);
				t3lib_FlashMessageQueue::addMessage($message);
				return;
			}
		}

		// Get database field value.
		// If field name of given type is not in the configuration and is not found in the database throw an error.
		if (!array_key_exists($tableSettings['fieldNames']['coordinates'], $currentField['row'])) {
			$message = t3lib_div::makeInstance('t3lib_FlashMessage', 'Mapping field "coordinates" ("' . $tableSettings['fieldNames']['coordinates'] . '") is not a database field.<br />See: plugin.tx_adgooglemapsapi.settings.mapDrawer.mapping.' . $currentField['table'] . '.coordinates', 'tx_adgooglemapsapi: Invalid extension configuration', t3lib_FlashMessage::ERROR);
			t3lib_FlashMessageQueue::addMessage($message);
			return;
		}

		// Get language overlay on translate.
		$defaultLanguageDataKey = $currentField['table'] . ':' . $currentField['row']['uid'];
		if (array_key_exists($defaultLanguageDataKey, $currentField['pObj']->defaultLanguageData) && $currentField['itemFormElValue'] === '' && $currentField['pObj']->defaultLanguageData[$defaultLanguageDataKey]['coordinates'] !== '') {
			$currentField['itemFormElValue'] = $currentField['pObj']->defaultLanguageData[$defaultLanguageDataKey]['coordinates'];
		}

		$objectId = 'Tx_AdGoogleMapsApi_Service_MapDrawer_' . $currentField['row']['uid'];

		// Prepare $currentField for view.
		$currentField['itemFormElID'] = htmlspecialchars($currentField['itemFormElID']);
		$currentField['fieldChangeFunc'] = htmlspecialchars(implode('', $currentField['fieldChangeFunc']));
		// Repair coordinates field.
		$currentField['itemFormElValue'] = preg_match('/^(-?\d+\.?\d*\s*,\s*-?\d+\.?\d*\n?)*/', $currentField['itemFormElValue'], $matches) ? $currentField['itemFormElValue'] : '';

		$shapeOptions = array();
		if ($layerType === 'tx_adgooglemapsapi_layers_polyline' || $layerType === 'tx_adgooglemapsapi_layers_polygon') {
			if (array_key_exists($tableSettings['optionsFieldMapping']['geodesic'], $currentField['row']) && $currentField['row'][$tableSettings['optionsFieldMapping']['geodesic']]) {
				$shapeOptions['geodesic'] = $currentField['row'][$tableSettings['optionsFieldMapping']['geodesic']];
			}
			if (array_key_exists($tableSettings['optionsFieldMapping']['strokeColor'], $currentField['row']) && $currentField['row'][$tableSettings['optionsFieldMapping']['strokeColor']]) {
				$shapeOptions['strokeColor'] = $currentField['row'][$tableSettings['optionsFieldMapping']['strokeColor']];
			}
			if (array_key_exists($tableSettings['optionsFieldMapping']['strokeWeight'], $currentField['row']) && $currentField['row'][$tableSettings['optionsFieldMapping']['strokeWeight']]) {
				$shapeOptions['strokeWeight'] = $currentField['row'][$tableSettings['optionsFieldMapping']['strokeWeight']];
			}
			if (array_key_exists($tableSettings['optionsFieldMapping']['strokeOpacity'], $currentField['row']) && $currentField['row'][$tableSettings['optionsFieldMapping']['strokeOpacity']]) {
				$shapeOptions['strokeOpacity'] = ($currentField['row'][$tableSettings['optionsFieldMapping']['strokeOpacity']] / 100);
			}
		}
		if ($layerType === 'tx_adgooglemapsapi_layers_polygon') {
			if (array_key_exists($tableSettings['optionsFieldMapping']['fillColor'], $currentField['row']) && $currentField['row'][$tableSettings['optionsFieldMapping']['fillColor']]) {
				$shapeOptions['fillColor'] = $currentField['row'][$tableSettings['optionsFieldMapping']['fillColor']];
			}
			if (array_key_exists($tableSettings['optionsFieldMapping']['fillOpacity'], $currentField['row']) && $currentField['row'][$tableSettings['optionsFieldMapping']['fillOpacity']]) {
				$shapeOptions['fillOpacity'] = ($currentField['row'][$tableSettings['optionsFieldMapping']['fillOpacity']] / 100);
			}
		}

		// Get min./max. zoom.
		$minZoom = (array_key_exists('minZoom', $this->settings['api']) === TRUE) ? intval($this->settings['api']['minZoom']) : 'null';
		$maxZoom = (array_key_exists('maxZoom', $this->settings['api']) === TRUE) ? intval($this->settings['api']['maxZoom']) : 'null';

		$settings = array(
			'pid' => $currentField['row']['pid'],
			'type' => $layerType,
			'objectId' => $objectId,
			'canvasId' => $objectId . '_canvas',
			'center' => $center,
			'minZoom' => $minZoom,
			'maxZoom' => $maxZoom,
			'onlyOneMarker' => (array_key_exists('onlyOneMarker', $tableSettings['fieldNames']) && $tableSettings['fieldNames']['onlyOneMarker']),
			'shapeOptions' => $shapeOptions,
			'coordinatesFieldId' => $currentField['itemFormElID'],
			'addressSearchFieldId' => $objectId . '_addressSearchField',
			'addressSearchButtonId' => $objectId . '_addressSearchButton',
		);

		// Append settings in JSON format.
		$settings['json'] = json_encode($settings);

		$this->view->assignMultiple(array('settings' => $settings));
		$this->view->assign('currentField', $currentField);
		$this->view->assign('formObject', $formObject);

		return $this->view->render();
	}

	/**
	 * Returns the Google Maps API URL.
	 *
	 * @return string
	 */
	protected function getGoogleMapsApiUrl() {
		$language = '&language=' . tx_AdGoogleMapsApi_Tools_BackEnd::getCurrentLanguage();
		return $this->settings['mapPlugin']['apiUrl'] . '?sensor=false' . $language;
	}

}

?>