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
class Tx_AdGoogleMapsApi_Layer_Marker extends Tx_AdGoogleMapsApi_Layer_AbstractLayer {

	/**
	 * @var Tx_AdGoogleMapsApi_Map
	 */
	protected $map;

	/**
	 * @var string
	 */
	protected $title;

	/**
	 * @var Tx_AdGoogleMapsApi_LatLng
	 */
	protected $position;

	/**
	 * @var boolean
	 */
	protected $visible;

	/**
	 * @var boolean
	 */
	protected $clickable;

	/**
	 * @var boolean
	 */
	protected $draggable;

	/**
	 * @var boolean
	 */
	protected $raiseOnDrag;

	/**
	 * @var integer
	 */
	protected $zindex;

	/**
	 * @var Tx_AdGoogleMapsApi_MarkerImage
	 */
	protected $icon;

	/**
	 * @var Tx_AdGoogleMapsApi_MarkerImage
	 */
	protected $shadow;

	/**
	 * @var boolean
	 */
	protected $flat;

	/**
	 * @var string
	 */
	protected $shapeType;

	/**
	 * @var string
	 */
	protected $shape;

	/**
	 * @var string
	 */
	protected $cursor;

	/**
	 * Sets this map.
	 *
	 * @param Tx_AdGoogleMapsApi_Map $map
	 * @return Tx_AdGoogleMapsApi_Layer_Marker
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
	 * Sets this title.
	 *
	 * @param string $title
	 * @return Tx_AdGoogleMapsApi_Layer_Marker
	 */
	public function setTitle($title) {
		$this->title = $title;
		return $this;
	}

	/**
	 * Returns this title.
	 *
	 * @return string
	 */
	public function getTitle() {
		return $this->title;
	}

	/**
	 * Sets this position.
	 *
	 * @param Tx_AdGoogleMapsApi_LatLng $position
	 * @return Tx_AdGoogleMapsApi_Layer_Marker
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
	 * Sets this visible.
	 *
	 * @param boolean $visible
	 * @return Tx_AdGoogleMapsApi_Layer_Marker
	 */
	public function setVisible($visible) {
		$this->visible = (boolean) $visible;
		return $this;
	}

	/**
	 * Returns this visible.
	 *
	 * @return boolean
	 */
	public function isVisible() {
		return (boolean) $this->visible;
	}

	/**
	 * Sets this clickable.
	 *
	 * @param boolean $clickable
	 * @return Tx_AdGoogleMapsApi_Layer_Marker
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
	 * Sets this draggable.
	 *
	 * @param boolean $draggable
	 * @return Tx_AdGoogleMapsApi_Layer_Marker
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
	 * Sets this raiseOnDrag.
	 *
	 * @param boolean $raiseOnDrag
	 * @return Tx_AdGoogleMapsApi_Layer_Marker
	 */
	public function setRaiseOnDrag($raiseOnDrag) {
		$this->raiseOnDrag = (boolean) $raiseOnDrag;
		return $this;
	}

	/**
	 * Returns this raiseOnDrag.
	 *
	 * @return boolean
	 */
	public function isRaiseOnDrag() {
		return (boolean) ($this->isDraggable() === TRUE && $this->raiseOnDrag === TRUE);
	}

	/**
	 * Sets this zindex.
	 *
	 * @param integer $zindex
	 * @return Tx_AdGoogleMapsApi_Layer_Marker
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
	 * Sets this icon.
	 *
	 * @param Tx_AdGoogleMapsApi_MarkerImage $icon
	 * @return Tx_AdGoogleMapsApi_Layer_Marker
	 */
	public function setIcon(Tx_AdGoogleMapsApi_MarkerImage $icon) {
		$this->icon = $icon;
		return $this;
	}

	/**
	 * Returns this icon.
	 *
	 * @return Tx_AdGoogleMapsApi_MarkerImage
	 */
	public function getIcon() {
		return $this->icon;
	}

	/**
	 * Sets this shadow.
	 *
	 * @param Tx_AdGoogleMapsApi_MarkerImage $shadow
	 * @return Tx_AdGoogleMapsApi_Layer_Marker
	 */
	public function setShadow(Tx_AdGoogleMapsApi_MarkerImage $shadow) {
		$this->shadow = $shadow;
		return $this;
	}

	/**
	 * Returns this shadow.
	 *
	 * @return Tx_AdGoogleMapsApi_MarkerImage
	 */
	public function getShadow() {
		return $this->shadow;
	}

	/**
	 * Sets this flat.
	 *
	 * @param boolean $flat
	 * @return Tx_AdGoogleMapsApi_Layer_Marker
	 */
	public function setFlat($flat) {
		$this->flat = (boolean) $flat;
		return $this;
	}

	/**
	 * Returns this flat.
	 *
	 * @return boolean
	 */
	public function isFlat() {
		return (boolean) $this->flat;
	}

	/**
	 * Sets this shapeType.
	 *
	 * @param string $shapeType
	 * @return Tx_AdGoogleMapsApi_Layer_Marker
	 */
	public function setShapeType($shapeType) {
		$this->shapeType = $shapeType;
		return $this;
	}

	/**
	 * Returns this shapeType.
	 *
	 * @return string
	 */
	public function getShapeType() {
		return $this->shapeType;
	}

	/**
	 * Sets this shape.
	 *
	 * @param string $shape
	 * @return Tx_AdGoogleMapsApi_Layer_Marker
	 */
	public function setShape($shape) {
		if (in_array($shape, array('', 'circle', 'poly', 'rect')) === FALSE) {
			throw new Tx_AdGoogleMapsApi_Exception('Invalid parameter value for Tx_AdGoogleMapsApi_Layer_Marker::setShape(), "' . $shape . '" given', 1294069168);
		}
		$this->shape = $shape;
		return $this;
	}

	/**
	 * Returns this shape.
	 *
	 * @return string
	 */
	public function getShape() {
		return $this->shape;
	}

	/**
	 * Sets this cursor
	 *
	 * @param string $cursor
	 * @return Tx_AdGoogleMapsApi_Layer_Marker
	 */
	public function setCursor($cursor) {
		$this->cursor = $cursor;
		return $this;
	}

	/**
	 * Returns this cursor
	 *
	 * @return string
	 */
	public function getCursor() {
		return $this->cursor;
	}

	/**
	 * Returns the marker options as array.
	 *
	 * @return array
	 */
	public function getOptionsArray() {
		// Required options.
		$options = array(
			'position: ' . $this->position,
		);
		// More options.
		if ($this->title) {
			$options[] = 'title: ' . '\'' . addcslashes($this->title, '\'') . '\'';
		}
		if ($this->visible === FALSE) {
			$options[] = 'visible: false';
		}
		if ($this->clickable === FALSE) {
			$options[] = 'clickable: false';
		}
		if ($this->draggable === TRUE) {
			$options[] = 'draggable: true';
		}
		if ($this->draggable === TRUE && $this->raiseOnDrag === FALSE) {
			$options[] = 'raiseOnDrag: false';
		}
		if ($this->zindex) {
			$options[] = 'zIndex: ' . $this->zindex;
		}
		if ($this->icon !== NULL) {
			$options[] = 'icon: ' . $this->icon;
		}
		if ($this->shadow !== NULL) {
			$options[] = 'shadow: ' . $this->shadow;
		}
		if ($this->flat === TRUE) {
			$options[] = 'flat: true';
		}
		if ($this->shapeType) {
			$options[] = 'shape: new google.maps.MarkerShape({ type: \'' . $this->shapeType . '\', coords: ' . $this->shape . ' })';
		}
		if ($this->cursor) {
			$options[] = 'cursor: ' . '\'' . $this->cursor . '\'';
		}

		return $options;
	}

	/**
	 * Returns the marker as JavaScript string.
	 *
	 * @return string
	 */
	public function getPrint() {
		return 'new google.maps.Marker({ ' . $this->getPrintOptions() . ' })';
	}

}

?>