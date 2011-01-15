<?php
$extensionClassesPath = t3lib_extMgm::extPath('ad_google_maps_api') . 'Classes/';
return array(
	'tx_adgooglemapsapi_tools_backend' => $extensionClassesPath . 'Tools/BackEnd.php',
	'tx_adgooglemapsapi_layers_layerinterface' => $extensionClassesPath . 'Layers/LayerInterface.php',
	'tx_adgooglemapsapi_layers_abstractlayer' => $extensionClassesPath . 'Layers/AbstractLayer.php',
	'tx_adgooglemapsapi_layers_infowindow' => $extensionClassesPath . 'Layers/InfoWindow.php',
	'tx_adgooglemapsapi_layers_marker' => $extensionClassesPath . 'Layers/Marker.php',
	'tx_adgooglemapsapi_layers_polyline' => $extensionClassesPath . 'Layers/Polyline.php',
	'tx_adgooglemapsapi_layers_polygon' => $extensionClassesPath . 'Layers/Polygon.php',
	'tx_adgooglemapsapi_latlng' => $extensionClassesPath . 'LatLng.php',
);
?>