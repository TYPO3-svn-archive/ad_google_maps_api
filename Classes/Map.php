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
 * Google Maps API class.
 * Nearly the same like the Google Maps API
 * @see http://code.google.com/apis/maps/documentation/javascript/reference.html
 *
 * @version $Id:$
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License, version 2
 * @package Extbase
 * @subpackage GoogleMapsAPI\Map
 * @scope prototype
 * @entity
 * @api
 */
class Tx_AdGoogleMapsApi_Map {

	/**
	 * @var string
	 */
	protected $mapTypeId;

	/**
	 * @var string
	 */
	protected $backgroundColor;

	/**
	 * @var string
	 */
	protected $centerType;

	/**
	 * @var Tx_AdGoogleMapsApi_LatLng
	 */
	protected $center;

	/**
	 * @var integer
	 */
	protected $zoom;

	/**
	 * @var integer
	 */
	protected $minZoom;

	/**
	 * @var integer
	 */
	protected $maxZoom;

	/**
	 * @var boolean
	 */
	protected $noClear;

	/**
	 * @var boolean
	 */
	protected $disableDefaultUi;

	/**
	 * @var boolean
	 */
	protected $mapTypeControl;

	/**
	 * @var Tx_AdGoogleMapsApi_ControlOptions_MapType
	 */
	protected $mapTypeControlOptions;

	/**
	 * @var boolean
	 */
	protected $navigationControl;

	/**
	 * @var Tx_AdGoogleMapsApi_ControlOptions_Navigation
	 */
	protected $navigationControlOptions;

	/**
	 * @var boolean
	 */
	protected $scaleControl;

	/**
	 * @var Tx_AdGoogleMapsApi_ControlOptions_Scale
	 */
	protected $scaleControlOptions;

	/**
	 * @var boolean
	 */
	protected $panControl;

	/**
	 * @var Tx_AdGoogleMapsApi_ControlOptions_Pan
	 */
	protected $panControlOptions;

	/**
	 * @var boolean
	 */
	protected $zoomControl;

	/**
	 * @var Tx_AdGoogleMapsApi_ControlOptions_Pan
	 */
	protected $zoomControlOptions;

	/**
	 * @var boolean
	 */
	protected $streetViewControl;

	/**
	 * @var Tx_AdGoogleMapsApi_ControlOptions_StreetView
	 */
	protected $streetViewControlOptions;

	/**
	 * @var boolean
	 */
	protected $disableDoubleClickZoom;

	/**
	 * @var boolean
	 */
	protected $scrollwheel;

	/**
	 * @var boolean
	 */
	protected $draggable;

	/**
	 * @var string
	 */
	protected $draggableCursor;

	/**
	 * @var string
	 */
	protected $draggingCursor;

	/**
	 * @var boolean
	 */
	protected $keyboardShortcuts;

	/*
	 * Constructs this map.
	 */
	public function __construct() {
		$settings = $GLOBALS['TSFE']->tmpl->setup['plugin.']['tx_adgooglemapsapi.']['settings.']['api.'];

		// Set required map options.
		$this->mapTypeId = $settings['mapTypeId'];
		$this->center = new Tx_AdGoogleMapsApi_LatLng($settings['center']);
		$this->zoom = $settings['zoom'];
	}

	/**
	 * Sets this mapTypeId.
	 *
	 * @param string $mapTypeId
	 * @return Tx_AdGoogleMapsApi_Map
	 */
	public function setMapTypeId($mapTypeId) {
		$this->mapTypeId = $mapTypeId;
		return $this;
	}

	/**
	 * Returns this mapTypeId.
	 *
	 * @return string
	 */
	public function getMapTypeId() {
		return $this->mapTypeId;
	}

	/**
	 * Sets this center.
	 x_AdGoogleMapsApi_LatLng $center
	 * @return Tx_AdGoogleMapsApi_Map
	 */
	public function setCenter(Tx_AdGoogleMapsApi_LatLng $center) {
		$this->center = $center;
		return $this;
	}

	/**
	 * Returns this center.
	 *
	 * @return Tx_AdGoogleMapsApi_LatLng
	 */
	public function getCenter() {
		return $this->center;
	}

	/**
	 * Sets this zoom.
	 *
	 * @param integer $zoom
	 * @return Tx_AdGoogleMapsApi_Map
	 */
	public function setZoom($zoom) {
		$this->zoom = (integer) $zoom;
		return $this;
	}

	/**
	 * Returns this zoom.
	 *
	 * @return integer
	 */
	public function getZoom() {
		return (integer) $this->zoom;
	}

	/**
	 * Sets this minZoom.
	 *
	 * @param integer $minZoom
	 * @return Tx_AdGoogleMapsApi_Map
	 */
	public function setMinZoom($minZoom) {
		$this->minZoom = (integer) $minZoom;
		return $this;
	}

	/**
	 * Returns this minZoom.
	 *
	 * @return integer
	 */
	public function getMinZoom() {
		return (integer) $this->minZoom;
	}

	/**
	 * Sets this maxZoom.
	 *
	 * @param integer $maxZoom
	 * @return Tx_AdGoogleMapsApi_Map
	 */
	public function setMaxZoom($maxZoom) {
		$this->maxZoom = (integer) $maxZoom;
		return $this;
	}

	/**
	 * Returns this maxZoom.
	 *
	 * @return integer
	 */
	public function getMaxZoom() {
		return (integer) $this->maxZoom;
	}

	/**
	 * Sets this backgroundColor.
	 *
	 * @param string $backgroundColor
	 * @return Tx_AdGoogleMapsApi_Map
	 */
	public function setBackgroundColor($backgroundColor) {
		$this->backgroundColor = $backgroundColor;
		return $this;
	}

	/**
	 * Returns this backgroundColor.
	 *
	 * @return string
	 */
	public function getBackgroundColor() {
		return $this->backgroundColor;
	}

	/**
	 * Sets this noClear.
	 *
	 * @param boolean $noClear
	 * @return Tx_AdGoogleMapsApi_Map
	 */
	public function setNoClear($noClear) {
		$this->noClear = (boolean) $noClear;
		return $this;
	}

	/**
	 * Returns this noClear.
	 *
	 * @return boolean
	 */
	public function isNoClear() {
		return (boolean) $this->noClear;
	}

	/**
	 * Sets this disableDefaultUi.
	 *
	 * @param boolean $disableDefaultUi
	 * @return Tx_AdGoogleMapsApi_Map
	 */
	public function setDisableDefaultUi($disableDefaultUi) {
		$this->disableDefaultUi = (boolean) $disableDefaultUi;
		return $this;
	}

	/**
	 * Returns this disableDefaultUi.
	 *
	 * @return boolean
	 */
	public function isDisableDefaultUi() {
		return (boolean) $this->disableDefaultUi;
	}

	/**
	 * Sets this mapTypeControl.
	 *
	 * @param boolean $mapTypeControl
	 * @return Tx_AdGoogleMapsApi_Map
	 */
	public function setMapTypeControl($mapTypeControl) {
		$this->mapTypeControl = (boolean) $mapTypeControl;
		return $this;
	}

	/**
	 * Returns this mapTypeControl.
	 *
	 * @return boolean
	 */
	public function hasMapTypeControl() {
		return (boolean) $this->mapTypeControl;
	}

	/**
	 * Sets this mapTypeControlOptions.
	 *
	 * @param Tx_AdGoogleMapsApi_ControlOptions_MapType $mapTypeControlOptions
	 * @return Tx_AdGoogleMapsApi_Map
	 */
	public function setMapTypeControlOptions(Tx_AdGoogleMapsApi_ControlOptions_MapType $mapTypeControlOptions) {
		$this->mapTypeControlOptions = $mapTypeControlOptions;
		return $this;
	}

	/**
	 * Returns this mapTypeControlOptions.
	 *
	 * @return Tx_AdGoogleMapsApi_ControlOptions_MapType
	 */
	public function getMapTypeControlOptions() {
		return $this->mapTypeControlOptions;
	}

	/**
	 * Sets this navigationControl.
	 *
	 * @param boolean $navigationControl
	 * @return Tx_AdGoogleMapsApi_Map
	 */
	public function setNavigationControl($navigationControl) {
		$this->navigationControl = (boolean) $navigationControl;
		return $this;
	}

	/**
	 * Returns this navigationControl.
	 *
	 * @return boolean
	 */
	public function hasNavigationControl() {
		return (boolean) $this->navigationControl;
	}

	/**
	 * Sets this navigationControlOptions.
	 *
	 * @param Tx_AdGoogleMapsApi_ControlOptions_Navigation $navigationControlOptions
	 * @return Tx_AdGoogleMapsApi_Map
	 */
	public function setNavigationControlOptions(Tx_AdGoogleMapsApi_ControlOptions_Navigation $navigationControlOptions) {
		$this->navigationControlOptions = $navigationControlOptions;
		return $this;
	}

	/**
	 * Returns this navigationControlOptions.
	 *
	 * @return Tx_AdGoogleMapsApi_ControlOptions_Navigation
	 */
	public function getNavigationControlOptions() {
		return $this->navigationControlOptions;
	}

	/**
	 * Sets this scaleControl.
	 *
	 * @param boolean $scaleControl
	 * @return Tx_AdGoogleMapsApi_Map
	 */
	public function setScaleControl($scaleControl) {
		$this->scaleControl = (boolean) $scaleControl;
		return $this;
	}

	/**
	 * Returns this scaleControl.
	 *
	 * @return boolean
	 */
	public function hasScaleControl() {
		return (boolean) $this->scaleControl;
	}

	/**
	 * Sets this scaleControlOptions.
	 *
	 * @param Tx_AdGoogleMapsApi_ControlOptions_Scale $scaleControlOptions
	 * @return Tx_AdGoogleMapsApi_Map
	 */
	public function setScaleControlOptions(Tx_AdGoogleMapsApi_ControlOptions_Scale $scaleControlOptions) {
		$this->scaleControlOptions = $scaleControlOptions;
		return $this;
	}

	/**
	 * Returns this scaleControlOptions.
	 *
	 * @return Tx_AdGoogleMapsApi_ControlOptions_Scale
	 */
	public function getScaleControlOptions() {
		return $this->scaleControlOptions;
	}

	/**
	 * Sets this panControl.
	 *
	 * @param boolean $panControl
	 * @return Tx_AdGoogleMapsApi_Map
	 */
	public function setPanControl($panControl) {
		$this->panControl = (boolean) $panControl;
		return $this;
	}

	/**
	 * Returns this panControl.
	 *
	 * @return boolean
	 */
	public function hasPanControl() {
		return (boolean) $this->panControl;
	}

	/**
	 * Sets this panControlOptions.
	 *
	 * @param Tx_AdGoogleMapsApi_ControlOptions_Pan $panControlOptions
	 * @return Tx_AdGoogleMapsApi_Map
	 */
	public function setPanControlOptions(Tx_AdGoogleMapsApi_ControlOptions_Pan $panControlOptions) {
		$this->panControlOptions = $panControlOptions;
		return $this;
	}

	/**
	 * Returns this panControlOptions.
	 *
	 * @return Tx_AdGoogleMapsApi_ControlOptions_Pan
	 */
	public function getPanControlOptions() {
		return $this->panControlOptions;
	}

	/**
	 * Sets this zoomControl.
	 *
	 * @param boolean $zoomControl
	 * @return Tx_AdGoogleMapsApi_Map
	 */
	public function setZoomControl($zoomControl) {
		$this->zoomControl = (boolean) $zoomControl;
		return $this;
	}

	/**
	 * Returns this zoomControl.
	 *
	 * @return boolean
	 */
	public function hasZoomControl() {
		return (boolean) $this->zoomControl;
	}

	/**
	 * Sets this zoomControlOptions.
	 *
	 * @param Tx_AdGoogleMapsApi_ControlOptions_Zoom $zoomControlOptions
	 * @return Tx_AdGoogleMapsApi_Map
	 */
	public function setZoomControlOptions(Tx_AdGoogleMapsApi_ControlOptions_Zoom $zoomControlOptions) {
		$this->zoomControlOptions = $zoomControlOptions;
		return $this;
	}

	/**
	 * Returns this zoomControlOptions.
	 *
	 * @return Tx_AdGoogleMapsApi_ControlOptions_Zoom
	 */
	public function getZoomControlOptions() {
		return $this->zoomControlOptions;
	}

	/**
	 * Sets this streetViewControl.
	 *
	 * @param boolean $streetViewControl
	 * @return Tx_AdGoogleMapsApi_Map
	 */
	public function setStreetViewControl($streetViewControl) {
		$this->streetViewControl = (boolean) $streetViewControl;
		return $this;
	}

	/**
	 * Returns this streetViewControl.
	 *
	 * @return boolean
	 */
	public function hasStreetViewControl() {
		return (boolean) $this->streetViewControl;
	}

	/**
	 * Sets this streetViewControlOptions.
	 *
	 * @param Tx_AdGoogleMapsApi_ControlOptions_StreetView $streetViewControlOptions
	 * @return Tx_AdGoogleMapsApi_Map
	 */
	public function setStreetViewControlOptions(Tx_AdGoogleMapsApi_ControlOptions_StreetView $streetViewControlOptions) {
		$this->streetViewControlOptions = $streetViewControlOptions;
		return $this;
	}

	/**
	 * Returns this streetViewControlOptions.
	 *
	 * @return Tx_AdGoogleMapsApi_ControlOptions_StreetView
	 */
	public function getStreetViewControlOptions() {
		return $this->streetViewControlOptions;
	}

	/**
	 * Sets this disableDoubleClickZoom.
	 *
	 * @param boolean $disableDoubleClickZoom
	 * @return Tx_AdGoogleMapsApi_Map
	 */
	public function setDisableDoubleClickZoom($disableDoubleClickZoom) {
		$this->disableDoubleClickZoom = (boolean) $disableDoubleClickZoom;
		return $this;
	}

	/**
	 * Returns this disableDoubleClickZoom.
	 *
	 * @return boolean
	 */
	public function isDisableDoubleClickZoom() {
		return (boolean) $this->disableDoubleClickZoom;
	}

	/**
	 * Sets this scrollwheel.
	 *
	 * @param boolean $scrollwheel
	 * @return Tx_AdGoogleMapsApi_Map
	 */
	public function setScrollwheel($scrollwheel) {
		$this->scrollwheel = (boolean) $scrollwheel;
		return $this;
	}

	/**
	 * Returns this scrollwheel.
	 *
	 * @return boolean
	 */
	public function hasScrollwheel() {
		return (boolean) $this->scrollwheel;
	}

	/**
	 * Sets this draggable.
	 *
	 * @param boolean $draggable
	 * @return Tx_AdGoogleMapsApi_Map
	 */
	public function setDraggable($draggable) {
		$this->draggable = (boolean) $draggable;
		return $this;
	}

	/**
	 * Returns this draggable.
	 *
	 * @return boolean
	 */
	public function isDraggable() {
		return (boolean) $this->draggable;
	}

	/**
	 * Sets this draggableCursor.
	 *
	 * @param string $draggableCursor
	 * @return Tx_AdGoogleMapsApi_Map
	 */
	public function setDraggableCursor($draggableCursor) {
		$this->draggableCursor = $draggableCursor;
		return $this;
	}

	/**
	 * Returns this draggableCursor.
	 *
	 * @return string
	 */
	public function getDraggableCursor() {
		return $this->draggableCursor;
	}

	/**
	 * Sets this draggingCursor.
	 *
	 * @param string $draggingCursor
	 * @return Tx_AdGoogleMapsApi_Map
	 */
	public function setDraggingCursor($draggingCursor) {
		$this->draggingCursor = $draggingCursor;
		return $this;
	}

	/**
	 * Returns this draggingCursor.
	 *
	 * @return string
	 */
	public function getDraggingCursor() {
		return $this->draggingCursor;
	}

	/**
	 * Sets this keyboardShortcuts.
	 *
	 * @param boolean $keyboardShortcuts
	 * @return Tx_AdGoogleMapsApi_Map
	 */
	public function setKeyboardShortcuts($keyboardShortcuts) {
		$this->keyboardShortcuts = (boolean) $keyboardShortcuts;
		return $this;
	}

	/**
	 * Returns this keyboardShortcuts.
	 *
	 * @return boolean
	 */
	public function hasKeyboardShortcuts() {
		return (boolean) $this->keyboardShortcuts;
	}

	/**
	 * Returns the map options as array.
	 *
	 * @return array
	 */
	public function getOptionsArray() {
		// Required map options.
		$options = array(
			'mapTypeId: ' . $this->mapTypeId,
			'center: ' . $this->center,
			'zoom: ' . $this->zoom,
		);
		// More map options.
		if ($this->minZoom) {
			$options[] = 'minZoom: ' . $this->minZoom;
		}
		if ($this->maxZoom) {
			$options[] = 'maxZoom: ' . $this->maxZoom;
		}
		if ($this->backgroundColor) {
			$options[] = 'backgroundColor: \'' . $this->backgroundColor . '\'';
		}
		if ($this->noClear === TRUE) {
			$options[] = 'noClear: true';
		}
		if ($this->disableDefaultUi === TRUE) {
			$options[] = 'disableDefaultUI: true';
		}
		if ($this->mapTypeControl === TRUE) {
			$options[] = 'mapTypeControl: true';
			if ($this->mapTypeControlOptions->hasOptions()) {
				$options[] = $this->mapTypeControlOptions;
			}
		}
		if ($this->navigationControl === TRUE) {
			$options[] = 'navigationControl: true';
			if ($this->navigationControlOptions->hasOptions()) {
				$options[] = $this->navigationControlOptions;
			}
		}
		if ($this->scaleControl === TRUE) {
			$options[] = 'scaleControl: true';
			if ($this->scaleControlOptions->hasOptions()) {
				$options[] = $this->scaleControlOptions;
			}
		}
		if ($this->panControl === TRUE) {
			$options[] = 'panControl: true';
			if ($this->panControlOptions->hasOptions()) {
				$options[] = $this->panControlOptions;
			}
		}
		if ($this->zoomControl === TRUE) {
			$options[] = 'zoomControl: true';
			if ($this->zoomControlOptions->hasOptions()) {
				$options[] = $this->zoomControlOptions;
			}
		}
		if ($this->streetViewControl === TRUE) {
			$options[] = 'streetViewControl: true';
			if ($this->streetViewControlOptions->hasOptions()) {
				$options[] = $this->streetViewControlOptions;
			}
		}
		if ($this->disableDoubleClickZoom === TRUE) {
			$options[] = 'disableDoubleClickZoom: true';
		}
		if ($this->scrollwheel === FALSE) {
			$options[] = 'scrollwheel: false';
		}
		if ($this->draggable === FALSE) {
			$options[] = 'draggable: false';
		}
		if ($this->draggableCursor) {
			$options[] = 'draggableCursor: \'' . $this->draggableCursor . '\'';
		}
		if ($this->draggingCursor) {
			$options[] = 'draggingCursor: \'' . $this->draggingCursor . '\'';
		}
		if ($this->keyboardShortcuts === FALSE) {
			$options[] = 'keyboardShortcuts: false';
		}

		return $options;
	}

	/**
	 * Returns the map options as JavaScript string.
	 *
	 * @return string
	 */
	public function getPrintOptions() {
		return implode(', ', $this->getOptionsArray());
	}

	/**
	 * Returns the map as JavaScript string.
	 *
	 * @return string
	 */
	public function getPrint() {
		return 'new google.maps.Map({ ' . $this->getPrintOptions() . ' })';
	}

	/**
	 * Returns the map as JavaScript string.
	 *
	 * @return string
	 */
	public function __toString() {
		return $this->getPrint();
	}

}

?>