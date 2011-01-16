###
# This are the default TS-constants
##

plugin.tx_adgooglemapsapi {
	settings {
		api {

			# cat=ad: Google Maps API/enable/10; type=string; label= Map type ID: The default mapTypeId. Required.
			mapTypeId = google.maps.MapTypeId.HYBRID

			# cat=ad: Google Maps API/enable/20; type=string; label= Center: The default latitude and longitude where the map should start. Required.
			center = 48.209206,16.372778

			# cat=ad: Google Maps API/enable/30; type=string; label= Zoom: The default zoom. Required.
			zoom = 11

			# cat=ad: Google Maps API/enable/40; type=string; label= Max. zoom: The max. zoom.
			maxZoom = 15

			# cat=ad: Google Maps API/enable/40; type=string; label= Min. zoom: The min. zoom.
			minZoom = 1
		}

		mapPlugin {

			# cat=ad: Google Maps API/enable/10; type=string; label= Google Maps API URL: Set parameters like "sensor" with the following options. Required.
			apiUrl = http://maps.google.com/maps/api/js

			# cat=ad: Google Maps API/enable/20; type=string; label= Google Maps API "language": Default language parameter. If set this language will be forced, else the current sys_language_uid will be used.
			apiLanguage = 

			# cat=ad: Google Maps API/enable/30; type=boolean; label= Google Maps API "sensor": Sensor parameter.
			apiSensor = 0

			# cat=ad: Google Maps API/enable/40; type=string; label= Google Maps API URL grocode: URL for getting geocode per JSON. Required.
			geocodeUrl = http://maps.google.com/maps/api/geocode/json

			# cat=ad: Google Maps API/enable/50; type=string; label= Google Maps JavaScript Plugin: Path to the Google Maps plugin. Required.
			pluginFile = EXT:ad_google_maps_api/Resources/Public/JavaScript/Tx_AdGoogleMapsApi_MapPlugin.js

			# cat=ad: Google Maps API/enable/60; type=string; label= The DIV container where the map is shown. Required.
			canvas = tx_adgooglemaps_canvas_uid
		}

		mapDrawer {

			# cat=ad: Google Maps API/enable/10; type=string; label= Google Maps Map Drawer Path: Path to the Google Maps Map Drawer. Required.
			pluginFile = EXT:ad_google_maps_api/Resources/Public/JavaScript/Tx_AdGoogleMapsApi_MapDrawer.js
		}
	}
}