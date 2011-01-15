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
 * MapPlugin class.
 *
 * @package Extbase
 * @subpackage GoogleMapsApi\Service\MapPlugin
 * @scope prototype
 * @entity
 * @api
 */
class Tx_AdGoogleMapsApi_Service_MapPlugin {

	/**
	 * @var boolean
	 */
	protected static $apiNotLoaded = TRUE;

	/**
	 * @var boolean
	 */
	protected static $pluginNotLoaded = TRUE;

	/**
	 * @var integer
	 */
	protected $width;

	/**
	 * @var integer
	 */
	protected $height;

	/**
	 * @var integer
	 */
	protected $mapId;

	/**
	 * @var string
	 */
	protected $apiUrl;

	/**
	 * @var string
	 */
	protected $apiLanguage;

	/**
	 * @var boolean
	 */
	protected $apiSensor;

	/**
	 * @var string
	 */
	protected $geocodeUrl;

	/**
	 * @var string
	 */
	protected $pluginFile;

	/**
	 * @var Tx_AdGoogleMapsApi_Map
	 */
	protected $map;

	/**
	 * @var Tx_AdGoogleMapsApi_Bounds
	 */
	protected $bounds;

	/**
	 * @var Tx_AdGoogleMapsApi_Layers_LayerObjectStore<Tx_AdGoogleMapsApi_Layers_LayerInterface>
	 */
	protected $layers;

	/**
	 * @var Tx_AdGoogleMapsApi_Layers_LayerObjectStore<Tx_AdGoogleMapsApi_Layers_LayerInterface>
	 */
	protected $infoWindows;

	/**
	 * @var boolean
	 */
	protected $infoWindowCloseAllOnMapClick;

	/**
	 * @var boolean
	 */
	protected $infoWindowKeepOpen;

	/**
	 * @var boolean
	 */
	protected $infoWindowCloseOnClick;

	/*
	 * Constructs this map.
	 */
	public function __construct() {
		// Get extension settings.
		$settings = $GLOBALS['TSFE']->tmpl->setup['plugin.']['tx_adgooglemapsapi.']['settings.']['mapPlugin.'];

		$this->map = new Tx_AdGoogleMapsApi_Map();
		$this->bounds = new Tx_AdGoogleMapsApi_Bounds();
		$this->layers = new Tx_AdGoogleMapsApi_Layers_LayerObjectStore();
		$this->infoWindows = new Tx_AdGoogleMapsApi_Layers_LayerObjectStore();

		// Set required plugin settings.
		$this->apiUrl = $settings['apiUrl'];
		$this->language = $settings['apiLanguage'] ? $settings['apiLanguage'] : tx_AdGoogleMapsApi_Tools_BackEnd::getCurrentLanguage();
		$this->sensor = (boolean) $settings['apiSensor'];
		$this->geocodeUrl = $settings['geocodeUrl'];
		$this->pluginFile = str_replace(PATH_site, '', t3lib_div::getFileAbsFileName($settings['pluginFile']));
		$this->canvas = $settings['canvas'];
	}

	/**
	 * Returns this apiNotLoaded. Is FALSE if allready printed out.
	 *
	 * @return boolean
	 */
	public function isApiNotLoaded() {
		return (boolean) self::$apiNotLoaded;
	}

	/**
	 * Returns this pluginNotLoaded. Is FALSE if allready printed out.
	 *
	 * @return boolean
	 */
	public function isPluginNotLoaded() {
		return (boolean) self::$pluginNotLoaded;
	}

	/**
	 * Sets this width.
	 *
	 * @param integer $width
	 * @return Tx_AdGoogleMaps_Service_MapPlugin
	 */
	public function setWidth($width) {
		$this->width = (integer) $width;
		return $this;
	}

	/**
	 * Returns this width.
	 *
	 * @return integer
	 */
	public function getWidth() {
		return (integer) $this->width;
	}

	/**
	 * Sets this height.
	 *
	 * @param integer $height
	 * @return Tx_AdGoogleMaps_Service_MapPlugin
	 */
	public function setHeight($height) {
		$this->height = (integer) $height;
		return $this;
	}

	/**
	 * Returns this height.
	 *
	 * @return integer
	 */
	public function getHeight() {
		return (integer) $this->height;
	}

	/**
	 * Sets this mapId.
	 *
	 * @param integer $mapId
	 * @return Tx_AdGoogleMaps_Service_MapPlugin
	 */
	public function setMapId($mapId) {
		$this->mapId = (integer) $mapId;
		return $this;
	}

	/**
	 * Returns this mapId.
	 *
	 * @return integer
	 */
	public function getMapId() {
		return (integer) $this->mapId;
	}

	/**
	 * Sets this apiUrl.
	 *
	 * @param string $apiUrl
	 * @return Tx_AdGoogleMaps_Service_MapPlugin
	 */
	public function setApiUrl($apiUrl) {
		$this->apiUrl = $apiUrl;
		return $this;
	}

	/**
	 * Returns this apiUrl.
	 *
	 * @return string
	 */
	public function getApiUrl() {
		return $this->apiUrl;
	}

	/**
	 * Sets this apiLanguage.
	 *
	 * @param string $apiLanguage
	 * @return Tx_AdGoogleMaps_Service_MapPlugin
	 */
	public function setApiLanguage($apiLanguage) {
		$this->apiLanguage = $apiLanguage;
		return $this;
	}

	/**
	 * Returns this apiLanguage.
	 *
	 * @return string
	 */
	public function getApiLanguage() {
		return $this->apiLanguage;
	}

	/**
	 * Sets this apiSensor.
	 *
	 * @param boolean $apiSensor
	 * @return Tx_AdGoogleMaps_Service_MapPlugin
	 */
	public function setApiSensor($apiSensor) {
		$this->apiSensor = (boolean) $apiSensor;
		return $this;
	}

	/**
	 * Returns this apiSensor.
	 *
	 * @return boolean
	 */
	public function isApiSensor() {
		return (boolean) $this->apiSensor;
	}

	/**
	 * Sets this geocodeUrl.
	 *
	 * @param string $geocodeUrl
	 * @return Tx_AdGoogleMaps_Service_MapPlugin
	 */
	public function setGeocodeUrl($geocodeUrl) {
		$this->geocodeUrl = $geocodeUrl;
		return $this;
	}

	/**
	 * Returns this geocodeUrl.
	 *
	 * @return string
	 */
	public function getGeocodeUrl() {
		return $this->geocodeUrl;
	}

	/**
	 * Sets this pluginFile.
	 *
	 * @param string $pluginFile
	 * @return Tx_AdGoogleMaps_Service_MapPlugin
	 */
	public function setPluginFile($pluginFile) {
		$this->pluginFile = $pluginFile;
		return $this;
	}

	/**
	 * Returns this pluginFile.
	 *
	 * @return string
	 */
	public function getPluginFile() {
		return $this->pluginFile;
	}

	/**
	 * Sets this map.
	 *
	 * @param Tx_AdGoogleMapsApi_Map $map
	 * @return Tx_AdGoogleMaps_Service_MapPlugin
	 */
	public function setMap(Tx_AdGoogleMapsApi_Map $map) {
		$this->map = $map;
		return $this;
	}

	/**
	 * Returns this map.
	 *
	 * @return Tx_AdGoogleMapsApi_Map
	 */
	public function getMap() {
		return $this->map;
	}

	/**
	 * Sets this bounds.
	 *
	 * @param Tx_AdGoogleMapsApi_Bounds $bounds
	 * @return Tx_AdGoogleMaps_Service_MapPlugin
	 */
	public function setBounds(Tx_AdGoogleMapsApi_Bounds $bounds) {
		$this->bounds = $bounds;
		return $this;
	}

	/**
	 * Returns this bounds.
	 *
	 * @return Tx_AdGoogleMapsApi_Bounds
	 */
	public function getBounds() {
		return $this->bounds;
	}

	/**
	 * Sets this layers.
	 *
	 * @param Tx_AdGoogleMapsApi_Layers_LayerObjectStore<Tx_AdGoogleMapsApi_Layers_LayerInterface> $layers
	 * @return Tx_AdGoogleMaps_Service_MapPlugin
	 */
	public function setLayers(Tx_AdGoogleMapsApi_Layers_LayerObjectStore $layers) {
		$this->layers = $layers;
		return $this;
	}

	/**
	 * Add a layer to this layers.
	 *
	 * @param Tx_AdGoogleMapsApi_Layers_LayerInterface $layers
	 * @return Tx_AdGoogleMaps_Service_MapPlugin
	 */
	public function addLayer(Tx_AdGoogleMapsApi_Layers_LayerInterface $layer) {
		$this->layers->attach($layer);
		return $this;
	}

	/**
	 * Remove a layer of this layers.
	 *
	 * @param Tx_AdGoogleMapsApi_Layers_LayerInterface $layers
	 * @return Tx_AdGoogleMaps_Service_MapPlugin
	 */
	public function removeLayer(Tx_AdGoogleMapsApi_Layers_LayerInterface $layer) {
		$this->layers->detach($layer);
		return $this;
	}

	/**
	 * Returns this layers.
	 *
	 * @return Tx_AdGoogleMapsApi_Layers_LayerObjectStore<Tx_AdGoogleMapsApi_Layers_LayerInterface>
	 */
	public function getLayers() {
		return $this->layers;
	}

	/**
	 * Sets this infoWindows.
	 *
	 * @param Tx_AdGoogleMapsApi_Layers_LayerObjectStore<Tx_AdGoogleMapsApi_Layers_InfoWindow> $infoWindows
	 * @return Tx_AdGoogleMaps_Service_MapPlugin
	 */
	public function setInfoWindows(Tx_AdGoogleMapsApi_Layers_LayerObjectStore $infoWindows) {
		$this->infoWindows = $infoWindows;
		return $this;
	}

	/**
	 * Add a infoWindow to this infoWindows.
	 *
	 * @param Tx_AdGoogleMapsApi_Layers_InfoWindow $infoWindows
	 * @return Tx_AdGoogleMaps_Service_MapPlugin
	 */
	public function addInfoWindow(Tx_AdGoogleMapsApi_Layers_InfoWindow $infoWindow) {
		$this->infoWindows->attach($infoWindow);
		return $this;
	}

	/**
	 * Remove a infoWindow of this infoWindows.
	 *
	 * @param Tx_AdGoogleMapsApi_Layers_InfoWindow $infoWindows
	 * @return Tx_AdGoogleMaps_Service_MapPlugin
	 */
	public function removeInfoWindow(Tx_AdGoogleMapsApi_Layers_InfoWindow $infoWindow) {
		$this->infoWindows->detach($infoWindow);
		return $this;
	}

	/**
	 * Returns this infoWindows.
	 *
	 * @return Tx_AdGoogleMapsApi_InfoWindows_InfoWindowObjectStore<Tx_AdGoogleMapsApi_Layers_InfoWindow>
	 */
	public function getInfoWindows() {
		return $this->infoWindows;
	}

	/**
	 * Sets this infoWindowCloseAllOnMapClick.
	 *
	 * @param boolean $infoWindowCloseAllOnMapClick
	 * @return Tx_AdGoogleMaps_Service_MapPlugin
	 */
	public function setInfoWindowCloseAllOnMapClick($infoWindowCloseAllOnMapClick) {
		$this->infoWindowCloseAllOnMapClick = (boolean) $infoWindowCloseAllOnMapClick;
		return $this;
	}

	/**
	 * Returns this infoWindowCloseAllOnMapClick.
	 *
	 * @return boolean
	 */
	public function isInfoWindowCloseAllOnMapClick() {
		return (boolean) $this->infoWindowCloseAllOnMapClick;
	}

	/**
	 * Sets this infoWindowKeepOpen.
	 *
	 * @param array $infoWindowKeepOpen
	 * @return Tx_AdGoogleMaps_Service_MapPlugin
	 */
	public function setInfoWindowKeepOpen($infoWindowKeepOpen) {
		$this->infoWindowKeepOpen = $infoWindowKeepOpen;
		return $this;
	}

	/**
	 * Appends a item key to this infoWindowKeepOpen.
	 *
	 * @param string $itemKey
	 * @return Tx_AdGoogleMaps_Service_MapPlugin
	 */
	public function addInfoWindowKeepOpen($itemKey) {
		$this->infoWindowKeepOpen[] = $itemKey;
		return $this;
	}

	/**
	 * Returns this infoWindowKeepOpen.
	 *
	 * @return array
	 */
	public function getInfoWindowKeepOpen() {
		return $this->infoWindowKeepOpen;
	}

	/**
	 * Sets this infoWindowCloseOnClick.
	 *
	 * @param array $infoWindowCloseOnClick
	 * @return Tx_AdGoogleMaps_Service_MapPlugin
	 */
	public function setInfoWindowCloseOnClick($infoWindowCloseOnClick) {
		$this->infoWindowCloseOnClick = $infoWindowCloseOnClick;
		return $this;
	}

	/**
	 * Appends a item key to this infoWindowCloseOnClick.
	 *
	 * @param string $itemKey
	 * @return Tx_AdGoogleMaps_Service_MapPlugin
	 */
	public function addInfoWindowCloseOnClick($itemKey) {
		$this->infoWindowCloseOnClick[] = $itemKey;
		return $this;
	}

	/**
	 * Returns this infoWindowCloseOnClick.
	 *
	 * @return array
	 */
	public function getInfoWindowCloseOnClick() {
		return $this->infoWindowCloseOnClick;
	}

	/**
	 * Returns this canvas ID.
	 *
	 * @return string
	 */
	public function getCanvasId() {
		return str_replace('###UID###', $this->mapId, $this->canvas);
	}

	/**
	 * Returns the plugin object options identifier as string.
	 *
	 * @return string
	 */
	public function getPluginOptionsObjectIdentifier() {
		return $this->mapId ? 'Tx_AdGoogleMapsApi_MapPlugin_Options_Uid' . $this->mapId : 'Tx_AdGoogleMapsApi_MapPlugin_Options';
	}

	/**
	 * Returns the plugin object identifier as string.
	 *
	 * @return string
	 */
	public function getPluginMapObjectIdentifier() {
		return $this->mapId ? 'Tx_AdGoogleMapsApi_MapPlugin_Map_Uid' . $this->mapId : 'Tx_AdGoogleMapsApi_MapPlugin_Map';
	}

	/**
	 * Returns the initialize function as JavaScript string.
	 *
	 * @return string
	 */
	public function getPrintPluginInitializeFunction() {
		return $this->getPluginMapObjectIdentifier() . ' = new Tx_AdGoogleMapsApi_MapPlugin(' . $this->getPluginOptionsObjectIdentifier() . ');';
	}

	/**
	 * Returns this apiUrl as URL.
	 *
	 * @return string
	 */
	public function getPrintApiUrl() {
		self::$apiNotLoaded = FALSE;
		return $this->apiUrl . '?sensor=' . ($this->sensor ? 'true' : 'false') . ($this->language ? '&language=' . $this->language : '');
	}

	/**
	 * Returns this geocodeUrl as URL.
	 *
	 * @return string
	 */
	public function getPrintGeocodeUrl() {
		return $this->geocodeUrl . '?sensor=' . ($this->sensor ? 'true' : 'false');
	}

	/**
	 * Returns this plugin as URL.
	 *
	 * @return string
	 */
	public function getPrintPluginFile() {
		self::$pluginNotLoaded = FALSE;
		return $this->pluginFile;
	}

	/**
	 * Returns this canvas as HTML-DIV-Element.
	 *
	 * @return string
	 */
	public function getPrintCanvas() {
		$size = array();
		if ($this->height) $size[] = 'height: ' . $this->height . 'px';
		if ($this->width)  $size[] = 'width: ' . $this->width . 'px';
		$style = (count($size) ? ' style="' . implode('; ', t3lib_div::removeArrayEntryByValue($size, NULL)) . ';"' : '');
		return '<div id="' . $this->getCanvasId() . '"' . $style . '></div>';
	}

	/**
	 * Returns the mapCotrollOptions options as array.
	 *
	 * @return array
	 */
	public function getMapCotrollOptionsArray() {
		$options = array();
		$options[] = 'fitToBounds: ' . $this->bounds;
		$options[] = 'infoWindowCloseAllOnMapClick: ' . ($this->infoWindowCloseAllOnMapClick ? 'true' : 'false');

		foreach ($this->layers as $layer) {
			$layerOptions = array();
			$layerKey = $layer->getKey();
			if (in_array($layerKey, $this->infoWindowKeepOpen) === TRUE) {
				$layerOptions[] = 'infoWindowKeepOpen: true';
			}
			if (in_array($layerKey, $this->infoWindowCloseOnClick) === TRUE) {
				$layerOptions[] = 'infoWindowCloseOnClick: true';
			}
			if (count($layerOptions)) {
				$options[] = '\'' . $layerKey . '\': { ' . implode(', ', $layerOptions) . ' }';
			}
		}

		return $options;
	}

	/**
	 * Returns the mapCotrollOptions as JavaScript option string.
	 *
	 * @return string
	 */
	public function getMapCotrollOptions() {
		return implode(', ' , $this->getMapCotrollOptionsArray());
	}

	/**
	 * Returns the info window options as array.
	 *
	 * @return array
	 */
	protected function getInfoWindowOptionsArray() {
		$options = array();
		foreach ($this->getInfoWindows() as $infoWindow) {
			$options[] = '\'' . $infoWindow->getKey() . '\': { ' . $infoWindow->getPrintOptions() . ' }';
		}
		return $options;
	}

	/**
	 * Returns the info window options as JavaScript string.
	 *
	 * @return array
	 */
	protected function getInfoWindowOptions() {
		return implode(', ' , $this->getInfoWindowOptionsArray());
	}

	/**
	 * Returns the layer options as array.
	 *
	 * @return array
	 */
	protected function getLayerOptionsArray() {
		$options = array();
		foreach ($this->getLayers() as $layer) {
			$options[] = '\'' . $layer->getKey() . '\': { ' . $layer->getPrintOptions() . ' }';
		}
		return $options;
	}

	/**
	 * Returns the layer options as JavaScript string.
	 *
	 * @return array
	 */
	protected function getLayerOptions() {
		return implode(', ' , $this->getLayerOptionsArray());
	}

	/**
	 * Returns the plugin options as array.
	 *
	 * @return array
	 */
	public function getPrintOptionsArray() {
		$javaScript = array();
		$javaScript[] = $this->getPluginOptionsObjectIdentifier() . ' = {';
		$javaScript[] = 'canvas: \'' . $this->getCanvasId() . '\',';

		$javaScript[] = 'mapOptions: {';
		$javaScript[] = TAB . implode(', ' . LF . TAB, $this->map->getOptionsArray());
		$javaScript[] = '},';

		$javaScript[] = 'mapCotrollOptions: {';
		$javaScript[] = TAB . implode(', ' . LF . TAB, $this->getMapCotrollOptionsArray());
		$javaScript[] = '},';

		$javaScript[] = 'infoWindowOptions: {';
		$javaScript[] = TAB . implode(', ' . LF . TAB, $this->getInfoWindowOptionsArray());
		$javaScript[] = '},';

		$javaScript[] = 'layerOptions: {';
		$javaScript[] = TAB . implode(', ' . LF . TAB, $this->getLayerOptionsArray());
		$javaScript[] = '},';

		$javaScript[] = '}';

		return $javaScript;
	}

	/**
	 * Returns the plugin options as JavaScript string.
	 *
	 * @return string
	 */
	public function getPrintOptions() {
		return implode(LF, $this->getPrintOptionsArray());
	}

	/**
	 * Returns plugin options as JavaScript string.
	 *
	 * @return string
	 */
	public function getPrint() {
		return $this->getPrintOptions() . LF . $this->getPrintPluginInitializeFunction();
	}

	/**
	 * Returns the map as JavaScript string.
	 *
	 * @return string
	 */
	public function __toString() {
		return $this->getPrint();
	}

	/**
	 * Returns the address coordinate string. Returns NULL if no address found.
	 * 
	 * @param string $addressQuery
	 * @return string
	 */
	public function getCoordinatesByAddress($addressQuery) {
		$coordinate = NULL;
		$geocodeUrl = $this->getGeocodeUrl();
		$geocodeUrl .= '?sensor=false&address=' . urlencode(str_replace(LF, ', ', $addressQuery));
		$geocodeResult = t3lib_div::getURL($geocodeUrl);
		$geocodeResult = json_decode($geocodeResult);
		if ($geocodeResult !== NULL && strtolower($geocodeResult->status) === 'ok') {
			$coordinate = $geocodeResult->results[0]->geometry->location->lat . ',' . $geocodeResult->results[0]->geometry->location->lng;
		}
		return $coordinate;
	}

	/**
	 * Returns the address LatLng object. Returns NULL if no address found.
	 * 
	 * @param string $addressQuery
	 * @return Tx_AdGoogleMapsApi_LatLng
	 */
	public function getLatLngByAddress($addressQuery) {
		$latLng = NULL;
		$geocodeUrl = $this->getGeocodeUrl();
		$geocodeUrl .= '?sensor=false&address=' . urlencode(str_replace(LF, ', ', $addressQuery));
		$geocodeResult = t3lib_div::getURL($geocodeUrl);
		$geocodeResult = json_decode($geocodeResult);
		if ($geocodeResult !== NULL && strtolower($geocodeResult->status) === 'ok') {
			$coordinates = new Tx_AdGoogleMapsApi_LatLng($geocodeResult->results[0]->geometry->location->lat, $geocodeResult->results[0]->geometry->location->lng);
		}
		return $latLng;
	}

}

?>