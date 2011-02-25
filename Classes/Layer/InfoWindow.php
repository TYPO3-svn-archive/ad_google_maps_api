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
class Tx_AdGoogleMapsApi_Layer_InfoWindow extends Tx_AdGoogleMapsApi_Layer_AbstractLayer {

	/**
	 * @var Tx_AdGoogleMapsApi_LatLng
	 */
	protected $position;

	/**
	 * @var string
	 */
	protected $content;

	/**
	 * @var boolean
	 */
	protected $disableAutoPan;

	/**
	 * @var integer
	 */
	protected $maxWidth;

	/**
	 * @var integer
	 */
	protected $pixelOffsetWidth;

	/**
	 * @var integer
	 */
	protected $pixelOffsetHeight;

	/**
	 * @var integer
	 */
	protected $zindex;

	/**
	 * Sets this position.
	 *
	 * @param Tx_AdGoogleMapsApi_LatLng $position
	 * @return Tx_AdGoogleMapsApi_Layer_InfoWindow
	 */
	public function setPosition(Tx_AdGoogleMapsApi_LatLng $position) {
		$this->position = $position;
		return $this;
	}

	/**
	 * Returns this position.
	 *
	 * @return Tx_AdGoogleMapsApi_LatLng
	 */
	public function getPosition() {
		return $this->position;
	}

	/**
	 * Sets this content.
	 *
	 * @param string $content
	 * @return Tx_AdGoogleMapsApi_Layer_InfoWindow
	 */
	public function setContent($content) {
		$this->content = $content;
		return $this;
	}

	/**
	 * Returns this content.
	 *
	 * @return string
	 */
	public function getContent() {
		return $this->content;
	}

	/**
	 * Sets this disableAutoPan.
	 *
	 * @param boolean $disableAutoPan
	 * @return Tx_AdGoogleMapsApi_Layer_InfoWindow
	 */
	public function setDisableAutoPan($disableAutoPan) {
		$this->disableAutoPan = (boolean) $disableAutoPan;
		return $this;
	}

	/**
	 * Returns this disableAutoPan.
	 *
	 * @return boolean
	 */
	public function isDisableAutoPan() {
		return (boolean) $this->disableAutoPan;
	}

	/**
	 * Sets this maxWidth.
	 *
	 * @param integer $maxWidth
	 * @return Tx_AdGoogleMapsApi_Layer_InfoWindow
	 */
	public function setMaxWidth($maxWidth) {
		$this->maxWidth = (integer) $maxWidth;
		return $this;
	}

	/**
	 * Returns this maxWidth.
	 *
	 * @return integer
	 */
	public function getMaxWidth() {
		return (integer) $this->maxWidth;
	}

	/**
	 * Sets this pixelOffsetWidth.
	 *
	 * @param integer $pixelOffsetWidth
	 * @return Tx_AdGoogleMapsApi_Layer_InfoWindow
	 */
	public function setPixelOffsetWidth($pixelOffsetWidth) {
		$this->pixelOffsetWidth = (integer) $pixelOffsetWidth;
		return $this;
	}

	/**
	 * Returns this pixelOffsetWidth.
	 *
	 * @return integer
	 */
	public function getPixelOffsetWidth() {
		return (integer) $this->pixelOffsetWidth;
	}

	/**
	 * Sets this pixelOffsetHeight.
	 *
	 * @param integer $pixelOffsetHeight
	 * @return Tx_AdGoogleMapsApi_Layer_InfoWindow
	 */
	public function setPixelOffsetHeight($pixelOffsetHeight) {
		$this->pixelOffsetHeight = (integer) $pixelOffsetHeight;
		return $this;
	}

	/**
	 * Returns this pixelOffsetHeight.
	 *
	 * @return integer
	 */
	public function getPixelOffsetHeight() {
		return (integer) $this->pixelOffsetHeight;
	}

	/**
	 * Sets this zindex.
	 *
	 * @param integer $zindex
	 * @return Tx_AdGoogleMapsApi_Layer_InfoWindow
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
	 * Returns the info window options as array.
	 *
	 * @return array
	 */
	public function getOptionsArray() {
		$options = array();
		if ($this->position) {
			$options[] = 'position: ' . $this->position;
		}
		if ($this->content) {
			$options[] = 'content:' . '\'' . addcslashes(str_replace(array("\r", LF), '\n', $this->content), '\'') . '\'';
		}
		if ($this->disableAutoPan === TRUE) {
			$options[] = 'disableAutoPan: true';
		}
		if ($this->zindex) {
			$options[] = 'zIndex: ' . $this->zindex;
		}
		if ($this->maxWidth) {
			$options[] = 'maxWidth: ' . $this->maxWidth;
		}
		if ($this->pixelOffsetWidth && $this->pixelOffsetHeight) {
			$options[] = 'pixelOffset: ' . 'new google.maps.Size(' . $this->pixelOffsetWidth . ', ' . $this->pixelOffsetHeight . ')';
		}

		return $options;
	}

	/**
	 * Returns the info window as JavaScript string.
	 *
	 * @return string
	 */
	public function getPrint() {
		return 'new google.maps.InfoWindow({ ' . $this->getPrintOptions() . ' })';
	}

}

?>