<?php

########################################################################
# Extension Manager/Repository config file for ext "ad_google_maps_api".
#
# Auto generated 03-03-2011 12:54
#
# Manual updates:
# Only the data in the array - everything else is removed by next
# writing. "version" and "dependencies" must not be touched!
########################################################################

$EM_CONF[$_EXTKEY] = array(
	'title' => 'ad: Google Maps API',
	'description' => 'Google Maps API for TYPO3. This Extension provide an API for Google Maps API V3 and a plugin to integrate in an extension. Based on extbase and fluid v1.2.1. Please test and response ;)',
	'category' => 'plugin',
	'shy' => 0,
	'version' => '1.0.5',
	'dependencies' => 'extbase,fluid',
	'conflicts' => '',
	'priority' => '',
	'loadOrder' => '',
	'module' => '',
	'state' => 'beta',
	'uploadfolder' => 0,
	'createDirs' => '',
	'modify_tables' => '',
	'clearcacheonload' => 0,
	'lockType' => '',
	'author' => 'Arno Dudek',
	'author_email' => 'webmaster@adgrafik.at',
	'author_company' => 'ad:grafik',
	'CGLcompliance' => '',
	'CGLcompliance_note' => '',
	'constraints' => array(
		'depends' => array(
			'typo3' => '4.4.5-0.0.0',
			'extbase' => '1.2.1-',
			'fluid' => '1.2.1-',
		),
		'conflicts' => array(
		),
		'suggests' => array(
		),
	),
	'_md5_values_when_last_written' => 'a:46:{s:9:"ChangeLog";s:4:"3bb3";s:16:"ext_autoload.php";s:4:"304f";s:12:"ext_icon.gif";s:4:"2650";s:14:"ext_tables.php";s:4:"33c5";s:21:"Classes/Exception.php";s:4:"1e1f";s:22:"Classes/Api/Bounds.php";s:4:"7589";s:22:"Classes/Api/LatLng.php";s:4:"bbd0";s:27:"Classes/Api/LatLngArray.php";s:4:"9712";s:19:"Classes/Api/Map.php";s:4:"ade5";s:27:"Classes/Api/MarkerImage.php";s:4:"d76f";s:53:"Classes/Api/ControlOptions/AbstractControlOptions.php";s:4:"ff93";s:38:"Classes/Api/ControlOptions/MapType.php";s:4:"e750";s:41:"Classes/Api/ControlOptions/Navigation.php";s:4:"371c";s:34:"Classes/Api/ControlOptions/Pan.php";s:4:"9ba4";s:36:"Classes/Api/ControlOptions/Scale.php";s:4:"65d9";s:41:"Classes/Api/ControlOptions/StreetView.php";s:4:"da1b";s:35:"Classes/Api/ControlOptions/Zoom.php";s:4:"06bd";s:35:"Classes/Api/Layer/AbstractLayer.php";s:4:"972a";s:32:"Classes/Api/Layer/InfoWindow.php";s:4:"3a10";s:36:"Classes/Api/Layer/LayerInterface.php";s:4:"3ff9";s:38:"Classes/Api/Layer/LayerObjectStore.php";s:4:"84cc";s:28:"Classes/Api/Layer/Marker.php";s:4:"f9a8";s:29:"Classes/Api/Layer/Polygon.php";s:4:"95d3";s:30:"Classes/Api/Layer/Polyline.php";s:4:"1bf7";s:31:"Classes/MapDrawer/Exception.php";s:4:"f9ec";s:34:"Classes/MapDrawer/MapDrawerApi.php";s:4:"8d7a";s:41:"Classes/MapDrawer/Layer/AbstractLayer.php";s:4:"f372";s:34:"Classes/MapDrawer/Layer/Marker.php";s:4:"7dff";s:35:"Classes/MapDrawer/Layer/Polygon.php";s:4:"bd8b";s:36:"Classes/MapDrawer/Layer/Polyline.php";s:4:"c51c";s:29:"Classes/Plugin/GoogleMaps.php";s:4:"e286";s:35:"Classes/Plugin/Layer/InfoWindow.php";s:4:"f495";s:31:"Classes/Plugin/Layer/Marker.php";s:4:"4d82";s:32:"Classes/Plugin/Layer/Polygon.php";s:4:"e139";s:33:"Classes/Plugin/Layer/Polyline.php";s:4:"def2";s:29:"Classes/Service/MapDrawer.php";s:4:"09b9";s:27:"Classes/Utility/BackEnd.php";s:4:"8f81";s:38:"Configuration/TypoScript/constants.txt";s:4:"df81";s:34:"Configuration/TypoScript/setup.txt";s:4:"2430";s:50:"Resources/Private/Language/locallang_constants.xml";s:4:"0ec7";s:50:"Resources/Private/Language/MapDrawer/locallang.xml";s:4:"4ecd";s:48:"Resources/Private/Templates/MapDrawer/index.html";s:4:"7098";s:43:"Resources/Public/Icons/MapDrawer/marker.png";s:4:"edef";s:49:"Resources/Public/Icons/MapDrawer/searchMarker.gif";s:4:"87c3";s:69:"Resources/Public/JavaScript/MapDrawer/Tx_AdGoogleMapsApi_MapDrawer.js";s:4:"20c7";s:63:"Resources/Public/JavaScript/Plugin/Tx_AdGoogleMapsApi_Plugin.js";s:4:"b261";}',
	'suggests' => array(
	),
);

?>