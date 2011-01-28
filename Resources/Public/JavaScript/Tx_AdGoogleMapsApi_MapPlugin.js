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
 * A Google Maps API JavaScript class for the MapPlugin.
 *
 * @version $Id:$
 * @copyright Copyright belongs to the respective authors
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License, version 2
 */
Tx_AdGoogleMapsApi_MapPlugin = function(options){
	var _this = this;

	this.options = options;
	this.canvas = document.getElementById(options.canvas);
	this.mapOptions = options.mapOptions;
	this.layerOptions = options.layerOptions;
	this.infoWindowOptions = options.infoWindowOptions;
	this.mapCotrollOptions = options.mapCotrollOptions;

	this.useMarkerCluster = (options.mapCotrollOptions.useMarkerCluster !== undefined);
	this.markerClusterer = {};
	this.markerClustererMarkers = [];

	this.map = {};
	this.layers = {};
	this.infoWindows = {};
	this.openedInfoWindows = {};
	this.geocoder = new google.maps.Geocoder();

	this.construct = function(){
		this.createMap();
		this.createLayers();
		if (this.useMarkerCluster === true) this.markerClusterer = new MarkerClusterer(this.map, this.markerClustererMarkers);
	};

	this.createMap = function(){
		this.map = new google.maps.Map(this.canvas, this.mapOptions);

		if (this.mapCotrollOptions.fitToBounds !== undefined){
			this.map.fitBounds(this.mapCotrollOptions.fitToBounds);
		}

		google.maps.event.addListener(this.map, 'click', function(event) {
			if (_this.mapCotrollOptions.infoWindowCloseAllOnMapClick === true){
				_this.closeAllInfoWindows();
			}
		});
	};

	this.createLayers = function(){
		for (var layerUid in this.layerOptions){
			// Don't allow undefined properties.
			if (this.mapCotrollOptions[layerUid] === undefined){
				this.mapCotrollOptions[layerUid] = {
					infoWindowKeepOpen: false,
					infoWindowCloseOnClick: false
				};
			}
			this.mapCotrollOptions[layerUid].infoWindowKeepOpen = this.mapCotrollOptions[layerUid].infoWindowKeepOpen === true;
			this.mapCotrollOptions[layerUid].infoWindowCloseOnClick = this.mapCotrollOptions[layerUid].infoWindowCloseOnClick === true;

			this.layerOptions[layerUid].map = this.map;
			switch (true){
				// Addresses
				case this.layerOptions[layerUid].address !== undefined:
					this.createMarkerByAddress(layerUid);
				break;
				// Markers
				case this.layerOptions[layerUid].position !== undefined:
					this.layers[layerUid] = new google.maps.Marker(this.layerOptions[layerUid]);
					if (this.useMarkerCluster === true) this.markerClustererMarkers.push(this.layers[layerUid]);
				break;
				// Polylines
				case this.layerOptions[layerUid].path !== undefined:
					this.layers[layerUid] = new google.maps.Polyline(this.layerOptions[layerUid]);
				break;
				// Polygons
				case this.layerOptions[layerUid].paths !== undefined:
					this.layers[layerUid] = new google.maps.Polygon(this.layerOptions[layerUid]);
				break;
				// KML files
				case this.layerOptions[layerUid].kml !== undefined:
					this.layers[layerUid] = new google.maps.KmlLayer(this.layerOptions[layerUid].kml, this.layerOptions[layerUid]);
				break;
			}
			this.createInfoWindow(layerUid);
		}
	};

	this.createMarkerByAddress = function(layerUid){
		this.geocoder.geocode({ 'address': this.layerOptions[layerUid].address }, function(results, status){
			if (status == google.maps.GeocoderStatus.OK) {
				this.layerOptions[layerUid].position = results[0].geometry.location;
				this.layers[layerUid] = new google.maps.Marker(this.layerOptions[layerUid]);
				this.markerClustererMarkers.push(this.layers[layerUid]);
			} else {
				console.log('Warning Tx_AdGoogleMapsApi_MapPlugin.createLayers(): Geocode was not successful for the following reason: ' + status);
			}
		});
	};

	this.createInfoWindow = function(layerUid){
		// Add click event listener only when info window exists.
		if (this.infoWindowOptions[layerUid]){
			this.infoWindows[layerUid] = new google.maps.InfoWindow(this.infoWindowOptions[layerUid]);

			google.maps.event.addListener(this.infoWindows[layerUid], 'closeclick', function(event) {
				delete _this.openedInfoWindows[layerUid];
			});

			google.maps.event.addListener(this.layers[layerUid], 'click', function(event) {
				_this.openInfoWindow(layerUid, null, event);
			});
		}
	};

	this.openInfoWindow = function(layerUid, atPoint, event){
		if (!_this.infoWindows[layerUid])
			return;
		if (_this.openedInfoWindows[layerUid] && _this.mapCotrollOptions[layerUid].infoWindowCloseOnClick === true){
			_this.closeInfoWindow(layerUid);
			return;
		}
		_this.closeAllInfoWindows(layerUid);

		if (!_this.openedInfoWindows[layerUid]){
			if (_this.layers[layerUid].getPosition){ // Open info window for marker.
				_this.infoWindows[layerUid].open(_this.map, _this.layers[layerUid]);
			} else { // Open info window for ohers.
				if (event === undefined){
					var bounds = new google.maps.LatLngBounds();
					var path = _this.layers[layerUid].getPath();
					if (atPoint === null || atPoint === undefined){
						path.forEach(function(element, index){
							bounds.extend(element);
						});
					} else {
						if (path.getAt(atPoint)){
							bounds.extend(path.getAt(atPoint));
						} else {
							bounds.extend(path.getAt(0));
							console.log('Error Tx_AdGoogleMapsApi_MapPlugin.openInfoWindow(): Given atPoint out of range. Useing first point.');
						}
					}
					position = bounds.getCenter();
				} else {
					position = event.latLng;
				}
				if (!_this.infoWindowOptions[layerUid].position){
					_this.infoWindows[layerUid].setPosition(position);
				}
				_this.infoWindows[layerUid].open(_this.map);
			}
			_this.openedInfoWindows[layerUid] = _this.infoWindows[layerUid];
		}
	};

	this.closeInfoWindow = function(layerUid){
		_this.openedInfoWindows[layerUid].close();
		delete _this.openedInfoWindows[layerUid];
	};

	this.closeAllInfoWindows = function(currentLayerUid){
		for (layerUid in _this.openedInfoWindows){
			if (currentLayerUid === undefined 
					|| (layerUid !== currentLayerUid && _this.mapCotrollOptions[layerUid].infoWindowKeepOpen === false)){
				_this.closeInfoWindow(layerUid);
			}
		}
	};

	this.panTo = function(layerUid){
		switch (true){
			// Markers
			case this.layerOptions[layerUid].position !== undefined:
				this.map.panTo(this.layers[layerUid].getPosition());
			break;
			// Shapes
			case (this.layerOptions[layerUid].path !== undefined || this.layerOptions[layerUid].paths !== undefined):
				var bounds = this.getBoundsOfLatLngArray(this.layers[layerUid].getPath());
				this.map.panToBounds(bounds);
			break;
			// KML
			case this.layerOptions[layerUid].kml !== undefined:
				var bounds = this.layers[layerUid].getDefaultViewport();
				this.map.panToBounds(bounds);
			break;
		}
	};

	this.fitBounds = function(layerUid){
		switch (true){
			// Markers
			case this.layerOptions[layerUid].position !== undefined:
				var bounds = new google.maps.LatLngBounds(this.layers[layerUid].getPosition(), this.layers[layerUid].getPosition());
				this.map.fitBounds(bounds);
			break;
			// Shapes
			case (this.layerOptions[layerUid].path !== undefined || this.layerOptions[layerUid].paths !== undefined):
				var bounds = this.getBoundsOfLatLngArray(this.layers[layerUid].getPath());
				this.map.fitBounds(bounds);
			break;
			// KML
			case this.layerOptions[layerUid].kml !== undefined:
				var bounds = this.layers[layerUid].getDefaultViewport();
				this.map.fitBounds(bounds);
			break;
		}
	};

	this.openedInfoWindowsLength = function(){
		var count = 0;
		for (var layerUid in _this.openedInfoWindows)
			count++;
		return count;
	};

	this.openedInfoWindowsGetLayerUidAt = function(index){
		var count = 0;
		for (var layerUid in _this.openedInfoWindows) {
			if (count === index) break;
			count++;
		}
		return layerUid;
	};

	this.getBoundsOfLatLngArray = function(latLngArray){
		var bounds = new google.maps.LatLngBounds();
		latLngArray.forEach(function(element, index){
			bounds.extend(element);
		});
		return bounds;
	};

	this.construct();
};