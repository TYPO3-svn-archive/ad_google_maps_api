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
 * @scope prototype
 * @api
 */
class Tx_AdGoogleMapsApi_Layer_Polygon extends Tx_AdGoogleMapsApi_Layer_AbstractLayer {

	/**
	 * @var Tx_AdGoogleMapsApi_Map
	 */
	protected $map;

	/**
	 * @var Tx_AdGoogleMapsApi_LatLngArray
	 */
	protected $paths;

	/**
	 * @var boolean
	 */
	protected $clickable;

	/**
	 * @var boolean
	 */
	protected $geodesic;

	/**
	 * @var integer
	 */
	protected $zindex;

	/**
	 * @var string
	 */
	protected $strokeColor;

	/**
	 * @var float
	 */
	protected $strokeOpacity;

	/**
	 * @var integer
	 */
	protected $strokeWeight;

	/**
	 * @var string
	 */
	protected $fillColor;

	/**
	 * @var float
	 */
	protected $fillOpacity;

	/**
	 * Sets this map.
	 *
	 * @param Tx_AdGoogleMapsApi_Map $map
	 * @return Tx_AdGoogleMapsApi_Layer_Polygon
	 */
	public function setMap($map) {
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
	 * Sets this paths.
	 *
	 * @param Tx_AdGoogleMapsApi_LatLngArray $paths
	 * @return Tx_AdGoogleMapsApi_Layer_Polygon
	 */
	public function setPaths(Tx_AdGoogleMapsApi_LatLngArray $paths) {
		$this->paths = $paths;
		return $this;
	}

	/**
	 * Adds a point to the path.
	 *
	 * @param Tx_AdGoogleMapsApi_LatLng $point
	 * @return Tx_AdGoogleMapsApi_Layer_Polygon
	 */
	public function addPoint(Tx_AdGoogleMapsApi_LatLng $point) {
		$this->paths->addLatLng($point);
		return $this;
	}

	/**
	 * Returns this paths.
	 *
	 * @return Tx_AdGoogleMapsApi_LatLngArray
	 */
	public function getPaths() {
		return $this->paths;
	}

	/**
	 * Sets this clickable.
	 *
	 * @param boolean $clickable
	 * @return Tx_AdGoogleMapsApi_Layer_Polygon
	 */
	public function setClickable($clickable) {
		$this->clickable = (boolean) $clickable;
		return $this;
	}

	/**
	 * Returns this clickable.
	 *
	 * @return boolean
	 */
	public function isClickable() {
		return (boolean) $this->clickable;
	}

	/**
	 * Sets this geodesic.
	 *
	 * @param boolean $geodesic
	 * @return Tx_AdGoogleMapsApi_Layer_Polygon
	 */
	public function setGeodesic($geodesic) {
		$this->geodesic = (boolean) $geodesic;
		return $this;
	}

	/**
	 * Returns this geodesic.
	 *
	 * @return boolean
	 */
	public function isGeodesic() {
		return (boolean) $this->geodesic;
	}

	/**
	 * Sets this zindex.
	 *
	 * @param integer $zindex
	 * @return Tx_AdGoogleMapsApi_Layer_Polygon
	 */
	public function setZindex($zindex) {
		$this->zindex = (integer) $zindex;
		return $this;
	}

	/**
	 * Returns this zindex.
	 *
	 * @return integer
	 */
	public function getZindex() {
		return (integer) $this->zindex;
	}

	/**
	 * Sets this strokeColor.
	 *
	 * @param string $strokeColor
	 * @return Tx_AdGoogleMapsApi_Layer_Polygon
	 */
	public function setStrokeColor($strokeColor) {
		$this->strokeColor = $strokeColor;
		return $this;
	}

	/**
	 * Returns this strokeColor.
	 *
	 * @return string
	 */
	public function getStrokeColor() {
		return $this->strokeColor;
	}

	/**
	 * Sets this strokeOpacity.
	 *
	 * @param float $strokeOpacity
	 * @return Tx_AdGoogleMapsApi_Layer_Polygon
	 */
	public function setStrokeOpacity($strokeOpacity) {
		$this->strokeOpacity = (float) $strokeOpacity;
		return $this;
	}

	/**
	 * Returns this strokeOpacity.
	 *
	 * @return float
	 */
	public function getStrokeOpacity() {
		return (float) $this->strokeOpacity;
	}

	/**
	 * Sets this strokeWeight.
	 *
	 * @param integer $strokeWeight
	 * @return Tx_AdGoogleMapsApi_Layer_Polygon
	 */
	public function setStrokeWeight($strokeWeight) {
		$this->strokeWeight = (integer) $strokeWeight;
		return $this;
	}

	/**
	 * Returns this strokeWeight.
	 *
	 * @return integer
	 */
	public function getStrokeWeight() {
		return (integer) $this->strokeWeight;
	}

	/**
	 * Sets this fillColor.
	 *
	 * @param string $fillColor
	 * @return Tx_AdGoogleMapsApi_Layer_Polygon
	 */
	public function setFillColor($fillColor) {
		$this->fillColor = $fillColor;
		return $this;
	}

	/**
	 * Returns this fillColor.
	 *
	 * @return string
	 */
	public function getFillColor() {
		return $this->fillColor;
	}

	/**
	 * Sets this fillOpacity.
	 *
	 * @param float $fillOpacity
	 * @return Tx_AdGoogleMapsApi_Layer_Polygon
	 */
	public function setFillOpacity($fillOpacity) {
		$this->fillOpacity = (float) $fillOpacity;
		return $this;
	}

	/**
	 * Returns this fillOpacity.
	 *
	 * @return float
	 */
	public function getFillOpacity() {
		return (float) $this->fillOpacity;
	}

	/**
	 * Returns the polygon options as array.
	 *
	 * @return array
	 */
	public function getOptionsArray() {
		// Required options.
		$options = array(
			'paths: ' . $this->paths,
		);
		// More options.
		if ($this->clickable === FALSE) {
			$options[] = 'clickable: false';
		}
		if ($this->geodesic === TRUE) {
			$options[] = 'geodesic: true';
		}
		if ($this->zindex) {
			$options[] = 'zIndex: ' . $this->zindex;
		}
		if ($this->strokeColor) {
			$options[] = 'strokeColor: ' . '\'' . $this->strokeColor . '\'';
		}
		if ($this->strokeOpacity) {
			$options[] = 'strokeOpacity: ' . $this->strokeOpacity;
		}
		if ($this->strokeWeight) {
			$options[] = 'strokeWeight: ' . $this->strokeWeight;
		}
		if ($this->fillColor) {
			$options[] = 'fillColor: ' . '\'' . $this->fillColor . '\'';
		}
		if ($this->fillOpacity) {
			$options[] = 'fillOpacity: ' . $this->fillOpacity;
		}

		return $options;
	}

	/**
	 * Returns the polygon as JavaScript string.
	 *
	 * @return string
	 */
	public function getPrint() {
		return 'new google.maps.Polygon({ ' . $this->getPrintOptions() . ' })';
	}

}

?>