<?php

########################################################################
# Extension Manager/Repository config file for ext "ad_google_maps_api".
#
# Auto generated 18-01-2011 13:50
#
# Manual updates:
# Only the data in the array - everything else is removed by next
# writing. "version" and "dependencies" must not be touched!
########################################################################

$EM_CONF[$_EXTKEY] = array(
	'title' => 'ad: Google Maps API',
	'description' => 'Google Maps API for TYPO3. This Extension provide an API for Google Maps API V3, a Map Drawer to set markers, polylines and polygons and a plugin to integrate on a page. Based on extbase and fluid v1.2.1. Please test and response ;)',
	'category' => 'plugin',
	'shy' => 0,
	'version' => '1.0.2',
	'dependencies' => 'extbase,fluid',
	'conflicts' => '',
	'priority' => '',
	'loadOrder' => '',
	'module' => '',
	'state' => 'alpha',
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
	'_md5_values_when_last_written' => 'a:41:{s:9:"ChangeLog";s:4:"18e1";s:16:"ext_autoload.php";s:4:"f398";s:12:"ext_icon.gif";s:4:"2650";s:14:"ext_tables.php";s:4:"d96d";s:18:"Classes/Bounds.php";s:4:"1728";s:21:"Classes/Exception.php";s:4:"1e1f";s:18:"Classes/LatLng.php";s:4:"0b42";s:23:"Classes/LatLngArray.php";s:4:"cd42";s:15:"Classes/Map.php";s:4:"991f";s:23:"Classes/MarkerImage.php";s:4:"7d18";s:49:"Classes/ControlOptions/AbstractControlOptions.php";s:4:"26d0";s:34:"Classes/ControlOptions/MapType.php";s:4:"6ef9";s:37:"Classes/ControlOptions/Navigation.php";s:4:"0ba4";s:30:"Classes/ControlOptions/Pan.php";s:4:"058a";s:32:"Classes/ControlOptions/Scale.php";s:4:"6d8d";s:37:"Classes/ControlOptions/StreetView.php";s:4:"7ec5";s:31:"Classes/ControlOptions/Zoom.php";s:4:"adb2";s:32:"Classes/Layers/AbstractLayer.php";s:4:"254b";s:29:"Classes/Layers/InfoWindow.php";s:4:"ff5a";s:22:"Classes/Layers/Kml.php";s:4:"0b1f";s:33:"Classes/Layers/LayerInterface.php";s:4:"3b5e";s:35:"Classes/Layers/LayerObjectStore.php";s:4:"fd41";s:25:"Classes/Layers/Marker.php";s:4:"a50d";s:26:"Classes/Layers/Polygon.php";s:4:"2d68";s:27:"Classes/Layers/Polyline.php";s:4:"4960";s:29:"Classes/Service/MapDrawer.php";s:4:"1f67";s:29:"Classes/Service/MapPlugin.php";s:4:"7303";s:59:"Classes/Service/MapPlugin/ExtendedApi/Layers/InfoWindow.php";s:4:"c156";s:52:"Classes/Service/MapPlugin/ExtendedApi/Layers/Kml.php";s:4:"c26d";s:55:"Classes/Service/MapPlugin/ExtendedApi/Layers/Marker.php";s:4:"dc34";s:56:"Classes/Service/MapPlugin/ExtendedApi/Layers/Polygon.php";s:4:"c4e9";s:57:"Classes/Service/MapPlugin/ExtendedApi/Layers/Polyline.php";s:4:"8e38";s:25:"Classes/Tools/BackEnd.php";s:4:"13b9";s:38:"Configuration/TypoScript/constants.txt";s:4:"6091";s:34:"Configuration/TypoScript/setup.txt";s:4:"e6d8";s:58:"Resources/Private/Language/Service/locallang_mapdrawer.xml";s:4:"195a";s:56:"Resources/Private/Templates/Service/MapDrawer/index.html";s:4:"638b";s:63:"Resources/Public/Icons/Service/MapDrawer/icon_locationpoint.gif";s:4:"87c3";s:51:"Resources/Public/Icons/Service/MapDrawer/marker.png";s:4:"edef";s:59:"Resources/Public/JavaScript/Tx_AdGoogleMapsApi_MapDrawer.js";s:4:"ad30";s:59:"Resources/Public/JavaScript/Tx_AdGoogleMapsApi_MapPlugin.js";s:4:"e0b1";}',
	'suggests' => array(
	),
);

?>