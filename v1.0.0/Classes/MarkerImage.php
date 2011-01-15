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
 * @subpackage GoogleMapsAPI\MarkerImage
 * @scope prototype
 * @entity
 * @api
 */
class Tx_AdGoogleMapsApi_MarkerImage {

	/**
	 * @var string
	 */
	protected $url;

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
	protected $originX;

	/**
	 * @var integer
	 */
	protected $originY;

	/**
	 * @var integer
	 */
	protected $anchorX;

	/**
	 * @var integer
	 */
	protected $anchorY;

	/**
	 * @var integer
	 */
	protected $scaledWidth;

	/**
	 * @var integer
	 */
	protected $scaledHeight;

	/*
	 * Constructor.
	 * 
	 * @param mixed $options
	 */
	public function __construct($options) {
		foreach ($options as $propertyName => $propertyValue) {
			$setterName = 'set' . ucfirst($propertyName);
			if (method_exists($this, $setterName)) {
				$this->$setterName($propertyValue);
			}
		}
	}

	/**
	 * Sets this url.
	 *
	 * @param string $url
	 * @return void
	 */
	public function setUrl($url) {
		$this->url = $url;
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
	 * Sets this width.
	 *
	 * @param integer $width
	 * @return void
	 */
	public function setWidth($width) {
		$this->width = (integer) $width;
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
	 * @return void
	 */
	public function setHeight($height) {
		$this->height = (integer) $height;
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
	 * Sets this originX.
	 *
	 * @param integer $originX
	 * @return void
	 */
	public function setOriginX($originX) {
		$this->originX = (integer) $originX;
	}

	/**
	 * Returns this originX.
	 *
	 * @return integer
	 */
	public function getOriginX() {
		return (integer) $this->originX;
	}

	/**
	 * Sets this originY.
	 *
	 * @param integer $originY
	 * @return void
	 */
	public function setOriginY($originY) {
		$this->originY = (integer) $originY;
	}

	/**
	 * Returns this originY.
	 *
	 * @return integer
	 */
	public function getOriginY() {
		return (integer) $this->originY;
	}

	/**
	 * Sets this anchorX.
	 *
	 * @param integer $anchorX
	 * @return void
	 */
	public function setAnchorX($anchorX) {
		$this->anchorX = (integer) $anchorX;
	}

	/**
	 * Returns this anchorX.
	 *
	 * @return integer
	 */
	public function getAnchorX() {
		return (integer) $this->anchorX;
	}

	/**
	 * Sets this anchorY.
	 *
	 * @param integer $anchorY
	 * @return void
	 */
	public function setAnchorY($anchorY) {
		$this->anchorY = (integer) $anchorY;
	}

	/**
	 * Returns this anchorY.
	 *
	 * @return integer
	 */
	public function getAnchorY() {
		return (integer) $this->anchorY;
	}

	/**
	 * Sets this scaledWidth.
	 *
	 * @param integer $scaledWidth
	 * @return void
	 */
	public function setScaledWidth($scaledWidth) {
		$this->scaledWidth = (integer) $scaledWidth;
	}

	/**
	 * Returns this scaledWidth.
	 *
	 * @return integer
	 */
	public function getScaledWidth() {
		return (integer) $this->scaledWidth;
	}

	/**
	 * Sets this scaledHeight.
	 *
	 * @param integer $scaledHeight
	 * @return void
	 */
	public function setScaledHeight($scaledHeight) {
		$this->scaledHeight = (integer) $scaledHeight;
	}

	/**
	 * Returns this scaledHeight.
	 *
	 * @return integer
	 */
	public function getScaledHeight() {
		return (integer) $this->scaledHeight;
	}

	/**
	 * Returns the marker image as JavaScript string.
	 *
	 * @return string
	 */
	public function getPrint() {
		if (!$this->url)
			return 'null';

		$options = array(
			'\'' . $this->url . '\'',
			($this->width && $this->height) ? sprintf('new google.maps.Size(%d, %d)', $this->width, $this->height) : 'null',
			($this->originX && $this->originY) ? sprintf('new google.maps.Point(%d, %d)', $this->originX, $this->originY) : 'null',
			($this->anchorX && $this->anchorY) ? sprintf('new google.maps.Point(%d, %d)', $this->anchorX, $this->anchorY) : 'null',
			($this->scaledWidth && $this->scaledHeight) ? sprintf('new google.maps.Size(%u, %u)', $this->scaledWidth, $this->scaledHeight) : 'null',
		);
		return 'new google.maps.MarkerImage(' . implode(', ', $options) . ')';
	}

	/**
	 * Returns the marker image as JavaScript string.
	 *
	 * @return string
	 */
	public function __toString() {
		return $this->getPrint();
	}

}

?>