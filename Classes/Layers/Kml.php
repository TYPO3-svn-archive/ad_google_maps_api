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
 * @subpackage GoogleMapsAPI\Layers\Kml
 * @scope prototype
 * @entity
 * @api
 */
class Tx_AdGoogleMapsApi_Layers_Kml extends Tx_AdGoogleMapsApi_Layers_AbstractLayer {

	/**
	 * @var Tx_AdGoogleMapsApi_Map
	 */
	protected $map;

	/**
	 * @var string
	 */
	protected $url;

	/**
	 * @var boolean
	 */
	protected $preserveViewport;

	/**
	 * @var boolean
	 */
	protected $suppressInfoWindows;

	/**
	 * Sets this map.
	 *
	 * @param Tx_AdGoogleMapsApi_Map $map
	 * @return Tx_AdGoogleMapsApi_Layers_Kml
	 */
	public function setMap($map) {
		$this->map = $map;
		return $this;
	}

	/**
	 * Sets this url.
	 *
	 * @param string $url
	 * @return Tx_AdGoogleMapsApi_Layers_Kml
	 */
	public function setUrl($url) {
		$this->url = $url;
		return $this;
	}

	/**
	 * Returns this url.
	 *
	 * @return string
	 */
	public function getUrl() {
		return $this->url;
	}

	/**
	 * Sets this preserveViewport.
	 *
	 * @param boolean $preserveViewport
	 * @return Tx_AdGoogleMapsApi_Layers_Kml
	 */
	public function setPreserveViewport($preserveViewport) {
		$this->preserveViewport = (boolean) $preserveViewport;
		return $this;
	}

	/**
	 * Returns this preserveViewport.
	 *
	 * @return boolean
	 */
	public function isPreserveViewport() {
		return (boolean) $this->preserveViewport;
	}

	/**
	 * Sets this suppressInfoWindows.
	 *
	 * @param boolean $suppressInfoWindows
	 * @return Tx_AdGoogleMapsApi_Layers_Kml
	 */
	public function setSuppressInfoWindows($suppressInfoWindows) {
		$this->suppressInfoWindows = (boolean) $suppressInfoWindows;
		return $this;
	}

	/**
	 * Returns this suppressInfoWindows.
	 *
	 * @return boolean
	 */
	public function isSuppressInfoWindows() {
		return (boolean) $this->suppressInfoWindows;
	}

	/**
	 * Returns the polyline options as array.
	 *
	 * @return array
	 */
	public function getOptionsArray() {
		if ($this->map !== NULL) {
			$options[] = 'map: ' . $this->map;
		}
		if ($this->preserveViewport === TRUE) {
			$options[] = 'preserveViewport: true';
		}
		if ($this->suppressInfoWindows === TRUE) {
			$options[] = 'suppressInfoWindows: true';
		}

		return $options;
	}

	/**
	 * Returns the polyline options as JavaScript string.
	 *
	 * @return array
	 */
	public function getPrintOptions() {
		return implode(', ', $this->getOptionsArray());
	}

	/**
	 * Returns the polyline as JavaScript string.
	 *
	 * @return string
	 */
	public function getPrint() {
		return 'new google.maps.KmlLayer(\'' . $this->url . '\', { ' . $this->getPrintOptions() . ' })';
	}

}

?>