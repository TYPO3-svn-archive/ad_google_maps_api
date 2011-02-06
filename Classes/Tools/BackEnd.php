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
 * Class for backend tools. 
 *
 * @version $Id:$
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License, version 2
 */
class tx_AdGoogleMapsApi_Tools_BackEnd {

	/**
	 * Initializes the current action
	 *
	 * @return void
	 */
	public static function getCurrentLanguage() {
		$pageRenderer = t3lib_div::makeInstance('t3lib_PageRenderer');
		$csConvObj = t3lib_div::makeInstance('t3lib_cs');

		$language = $pageRenderer->getLanguage();
		$localeMap = $csConvObj->isoArray; // load standard ISO mapping and modify for use.
		$localeMap['default'] = 'en';

		return (isset($localeMap[$language]) ? $localeMap[$language] : $language);
	}

	/**
	 * Reslove path prepend with "EXT:" and return it.
	 *
	 * @param string $fileName
	 * @param string $prefix
	 * @return string
	 */
	public static function getRelativePathAndFileName($fileName, $prefix = '') {
		return $prefix . str_replace(PATH_site, '', t3lib_div::getFileAbsFileName($fileName));
	}

}

?>