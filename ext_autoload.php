<?php
$extensionClassesPath = t3lib_extMgm::extPath('ad_google_maps_api') . 'Classes/';
return array(
	'tx_adgooglemapsapi_exception' => $extensionClassesPath . 'Exception.php',
	'tx_adgooglemapsapi_utility_backend' => $extensionClassesPath . 'Utility/BackEnd.php',
	'tx_adgooglemapsapi_utility_frontend' => $extensionClassesPath . 'Utility/FrontEnd.php',
	'tx_adgooglemapsapi_api_controloptions_abstractcontroloptions' => $extensionClassesPath . 'Api/ControlOptions/AbstractControlOptions.php',
	'tx_adgooglemapsapi_api_controloptions_maptype' => $extensionClassesPath . 'Api/ControlOptions/MapType.php',
	'tx_adgooglemapsapi_api_controloptions_navigation' => $extensionClassesPath . 'Api/ControlOptions/Navigation.php',
	'tx_adgooglemapsapi_api_controloptions_pan' => $extensionClassesPath . 'Api/ControlOptions/Pan.php',
	'tx_adgooglemapsapi_api_controloptions_scale' => $extensionClassesPath . 'Api/ControlOptions/Scale.php',
	'tx_adgooglemapsapi_api_controloptions_zoom' => $extensionClassesPath . 'Api/ControlOptions/Zoom.php',
	'tx_adgooglemapsapi_api_controloptions_streetview' => $extensionClassesPath . 'Api/ControlOptions/StreetView.php',
	'tx_adgooglemapsapi_api_layers_layerinterface' => $extensionClassesPath . 'Api/Layers/LayerInterface.php',
	'tx_adgooglemapsapi_api_layers_abstractlayer' => $extensionClassesPath . 'Api/Layers/AbstractLayer.php',
	'tx_adgooglemapsapi_api_layers_infowindow' => $extensionClassesPath . 'Api/Layers/InfoWindow.php',
	'tx_adgooglemapsapi_api_layers_marker' => $extensionClassesPath . 'Api/Layers/Marker.php',
	'tx_adgooglemapsapi_api_latlng' => $extensionClassesPath . 'Api/LatLng.php',
);
?>