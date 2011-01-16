###
# This is the default TS-setup
##

plugin.tx_adgooglemapsapi {
	settings {
		api {

			# The default mapTypeId. Required.
			mapTypeId = {$plugin.tx_adgooglemapsapi.settings.api.mapTypeId}

			# The default latitude and longitude where the map should start. Required.
			center = {$plugin.tx_adgooglemapsapi.settings.api.center}

			# The default zoom. Required.
			zoom = {$plugin.tx_adgooglemapsapi.settings.api.zoom}

			# Max. zoom: The max. zoom.
			maxZoom = {$plugin.tx_adgooglemapsapi.settings.api.maxZoom}

			# Min. zoom: The min. zoom.
			minZoom = {$plugin.tx_adgooglemapsapi.settings.api.minZoom}
		}

		mapPlugin {

			# Google Maps API URL: Set parameters like "sensor" with the following options. Overrides googleMapsApi.url of the extension config. Required.
			apiUrl = {$plugin.tx_adgooglemapsapi.settings.mapPlugin.apiUrl}

			# Google Maps API "language": Default language parameter. If set this language will be forced, else the current sys_language_uid will be used. Overrides googleMapsApi.language of the extension config.
			apiLanguage = {$plugin.tx_adgooglemapsapi.settings.mapPlugin.apiLanguage}

			# Google Maps API "sensor": Sensor parameter. Overrides googleMapsApi.sensor of the extension config.
			apiSensor = {$plugin.tx_adgooglemapsapi.settings.mapPlugin.apiSensor}

			# Google Maps API URL grocode: URL for getting geocode per JSON. Required.
			geocodeUrl = {$plugin.tx_adgooglemapsapi.settings.mapPlugin.geocodeUrl}

			# Google Maps Plugin: Path to the Google Maps plugin. Required.
			pluginFile = {$plugin.tx_adgooglemapsapi.settings.mapPlugin.pluginFile}

			# The DIV container where the map is shown. Required.
			canvas = {$plugin.tx_adgooglemapsapi.settings.mapPlugin.canvas}
		}

		mapDrawer {

			# Google Maps Map Drawer Path: Path to the Google Maps Map Drawer. Required.
			pluginFile = {$plugin.tx_adgooglemapsapi.settings.mapDrawer.pluginFile}

			# Settings to implement the Google Maps Map Drawer in other tables.
			mapping {

				# tt_address example:
				# See more settings in the ad_google_maps extension.
#				tt_address {
#					# Field mapping for the layer type: Set here the field name where the type of the Google Maps layer is defined. 
#					# If the type set to "tx_adgooglemapsapi_layers_marker" and there is no field with this name in the database, then the value is the current type. 
#					# In this case there is only one type supported. Required.
#					fieldNames.type = tx_adgooglemapsapi_layers_marker
#
#					# The latitude and longitude field. Required.
#					fieldNames.coordinates = tx_adgooglemaps_coordinates
#
#					# Set this option to set only one marker on the layer. Default you can set multiple markers.
#					onlyOneMarker = 1
#
#					# Field names witch match the option name. Usefull to see the color at once. Only shape options supported now. 
#					# Opacities must be percent values (e.g. "75" not "0.75"). (Not used for tt_address.)
#					optionsFieldMapping {
#						geodesic = geodesic
#						strokeColor = stroke_color
#						strokeWeight = stroke_weight
#						strokeOpacity = stroke_opacity
#						fillColor = fill_color
#						fillOpacity = fill_opacity
#					}
#				}
			}
		}
	}
}