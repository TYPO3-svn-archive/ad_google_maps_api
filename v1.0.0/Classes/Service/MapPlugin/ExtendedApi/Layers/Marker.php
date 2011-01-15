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
 * Google Maps API class extension.
 *
 * @version $Id:$
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License, version 2
 * @package Extbase
 * @subpackage GoogleMaps\Service\ExtendedApi\Layers\Marker
 * @scope prototype
 * @entity
 * @api
 */
class Tx_AdGoogleMapsApi_Service_MapPlugin_ExtendedApi_Layers_Marker extends Tx_AdGoogleMapsApi_Layers_Marker {

	/**
	 * @var string
	 */
	protected $key;

	/**
	 * Sets this key.
	 *
	 * @param string $key
	 * @return Tx_AdGoogleMapsApi_Service_MapPlugin_ExtendedApi_Layers_Marker
	 */
	public function setKey($key) {
		$this->key = $key;
		return $this;
	}

	/**
	 * Returns this key.
	 *
	 * @return string
	 */
	public function getKey() {
		return $this->key;
	}

}

?>