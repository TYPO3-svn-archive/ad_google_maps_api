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

Ext.ns('TYPO3');

/**
 * A Google Maps Api JavaScript class for the MapDrawer.
 *
 * @version $Id:$
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License, version 2
 */
TYPO3.Tx_AdGoogleMapsApi_MapDrawer = Ext.extend(Object, {

	LAYER_TYPE_MARKERS: 'tx_adgooglemapsapi_layers_marker',
	LAYER_TYPE_POLYLINE: 'tx_adgooglemapsapi_layers_polyline',
	LAYER_TYPE_POLYGON: 'tx_adgooglemapsapi_layers_polygon',

	markerIcon: {
		default: new google.maps.MarkerImage('../typo3conf/ext/ad_google_maps_api/Resources/Public/Icons/Service/MapDrawer/marker.png'),
		address: new google.maps.MarkerImage(
			'../typo3conf/ext/ad_google_maps_api/Resources/Public/Icons/Service/MapDrawer/searchMarker.gif', 
			new google.maps.Size(9, 9), 
			new google.maps.Point(0, 0), 
			new google.maps.Point(4, 5)
		)
	},

	type: null,
	geocoder: null,
	coordinatesField: null,
	addressSearchField: null,
	addressSearchButton: null,

	map: null,
	canvasId: null,
	center: null,
	minZoom: null,
	maxZoom: null,
	mapOptions: {
		mapTypeId: google.maps.MapTypeId.ROADMAP,
		center: null, // Gets overridden by coordinatesField or if empty by center.
		zoom: 8,
		streetViewControl: false
	},

	markers: null,
	onlyOneMarker: false,
	markerOptions: {
		map: null, // Gets overridden
		position: null, // Gets overridden
		icon: null, // Gets overridden
		zIndex: 2,
		draggable: true
	},

	shape: null,
	shapeOptions: {
		map: null, // Gets overridden
		clickable: false,
		geodesic: null,
		strokeColor: null,
		strokeWeight: null,
		strokeOpacity: null,
		fillColor: null,
		fillOpacity: null
	},

	addressMarker: null,
	addressMarkerInfo: null,
	addressMarkerOptions: {
		map: null,
		position: null, 
		icon: null,
		zIndex: 1
	},


	/**
	 * Constructor
	 *
	 * @param object options
	 * @return void
	 */
	constructor: function(options){
		Ext.apply(this, options);

		// Set visible of first TCA-Tab to draw map correctly.
		var tabHideAgain = false;
		var tab = Ext.get(this.canvasId).parent('.c-tablayer');
		if (!tab.isVisible()){
			tabHideAgain = true;
			tab.setVisibilityMode(Ext.Element.DISPLAY).show().setStyle({ height: 0, overflow: 'hidden' });
		}

		this.geocoder = new google.maps.Geocoder();

		this.coordinatesField = Ext.get(this.coordinatesFieldId);
		// Add change listener to coordinates field.
		this.coordinatesField.on('change', function(event, target){
			event.preventDefault();
			this.drawLayer(true, true);
		}, this);

		this.addressSearchField = Ext.get(this.addressSearchFieldId);
		this.addressSearchButton = Ext.get(this.addressSearchButtonId);
		// Prevent Geo Search to submit form by press ENTER and get location by field value. 
		this.addressSearchField.on('keydown', function(event, target){
			if (event.getKey() === event.ENTER){
				event.preventDefault();
				target.blur();
				this.setAddressMarker(target.value);
			}
		}, this);
		this.addressSearchButton.on('click', function(event, target){
			event.preventDefault();
			this.setAddressMarker(this.addressSearchField.getValue());
			return false;
		}, this);

		this.createMap();
		this.drawLayer(true);

		var projectionChangedListener = google.maps.event.addListener(this.map, 'bounds_changed', function(event){
			// Hide first TCA-Tab again.
			if (tabHideAgain) tab.setVisibilityMode(Ext.Element.DISPLAY).hide().setStyle({ height: 'auto', overflow: 'auto' });
			google.maps.event.removeListener(projectionChangedListener);
		});
	},

	/**
	 * Creates the map on the map canvas.
	 *
	 * @return void
	 */
	createMap: function(){
		var center = this.getLatLng(this.center);
		var canvas = Ext.getDom(this.canvasId);
		if (canvas === null){
			alert('Error Tx_AdGoogleMapsApi_MapDrawer.createMap(): Map container with ID "' + this.canvasId + '" not found.');
		} else {
			this.mapOptions.center = center;
			this.mapOptions.minZoom = this.minZoom;
			this.mapOptions.maxZoom = this.maxZoom;
			this.map = new google.maps.Map(canvas, this.mapOptions);
		}

		// Add click listener to the map.
		var _this = this;
		google.maps.event.addListener(this.map, 'click', function(event){
			_this.addPoint(event.latLng);
		});
	},

	/**
	 * Load markers from coordinates field.
	 *
	 * @param boolean fitBounds
	 * @param boolean resetMap
	 * @return void
	 */
	drawLayer: function(fitBounds, resetMap){
		if (fitBounds){
			var bounds = new google.maps.LatLngBounds();
		}

		if (resetMap){
			var _this = this;
			this.markers.forEach(function(element, index){
				_this.markers.getAt(index).setMap(null);
			});
		}

		if (this.type !== this.LAYER_TYPE_MARKERS){
			if (!this.shape){
				this.shapeOptions.map = this.map;
				switch (this.type){
					case this.LAYER_TYPE_POLYLINE:
						delete this.shapeOptions.fillColor;
						this.shape = new google.maps.Polyline(this.shapeOptions);
					break;
					case this.LAYER_TYPE_POLYGON:
						this.shape = new google.maps.Polygon(this.shapeOptions);
					break;
				}
			}
			this.shape.setPath(new google.maps.MVCArray());
		}

		this.markers = new google.maps.MVCArray(); // Reset this.markers.
		var coordinatesFieldValue = new Array();
		var markers = this.coordinatesField.getValue().split("\n");
		Ext.each(markers, function(point, index){
			var match = point.match(/-?\d+\.?\d*,-?\d+\.?\d*/);
			if (point && match){
				coordinatesFieldValue.push(match[0]);
				latLng = this.getLatLng(match[0]);
				this.addPoint(latLng);
				if (fitBounds) bounds.extend(latLng);
			}
		}, this);
		this.coordinatesField.dom.value = coordinatesFieldValue.join("\n");
		if (fitBounds && !bounds.isEmpty()) this.map.fitBounds(bounds);
	},

	/**
	 * Create a new draggable marker.
	 *
	 * @param google.maps.LatLng latLng
	 * @return void
	 */
	addPoint: function(latLng){
		if (this.onlyOneMarker && this.markers.getLength()){
			return;
		}
		this.markerOptions.map = this.map;
		this.markerOptions.position = latLng;
		this.markerOptions.icon = this.markerIcon.default;

		var marker = new google.maps.Marker(this.markerOptions);
		this.markers.push(marker);
		if (this.type !== this.LAYER_TYPE_MARKERS){
			this.shape.getPath().push(latLng);
		}

		this.updateCoordinatesField();

		var _this = this;
		var onDrag = function(event){
			_this.updateCoordinatesField();
		}
		google.maps.event.addListener(marker, 'dragend', onDrag);
		google.maps.event.addListener(marker, 'drag', onDrag);

		var onDblClick = function(event){
			var marker = this;
			_this.markers.forEach(function(element, index){
				if (element === marker){
					_this.removePoint(index);
				}
			});
			_this.updateCoordinatesField();
		}
		google.maps.event.addListener(marker, 'dblclick', onDblClick);
	},

	/**
	 * Removes the marker.
	 *
	 * @param integer index
	 * @return void
	 */
	removePoint: function(index){
		if (this.type !== this.LAYER_TYPE_MARKERS){
			this.shape.getPath().removeAt(index);
		}
		this.markers.getAt(index).setMap(null);
		this.markers.removeAt(index);
	},

	/**
	 * Event function on click the map.
	 *
	 * @param mixed coordinates
	 * @return void
	 */
	updateCoordinatesField: function(){
		var latLngs = new google.maps.MVCArray();
		var latLngsValues = [];
		this.markers.forEach(function(element, index){
			latLngs.push(element.getPosition());
			latLngsValues.push(element.getPosition().toUrlValue());
		});
		if (this.type !== this.LAYER_TYPE_MARKERS){
			this.shape.setPath(latLngs);
		}
		this.coordinatesField.dom.value = latLngsValues.join("\n");
	},

	/**
	 * Set marker position by given address.
	 *
	 * @param string address
	 * @return void
	 */
	setAddressMarker: function(address){
		var _this = this;
		this.geocoder.geocode({ 'address': address }, function(results, status){
			if (status == google.maps.GeocoderStatus.OK) {
				var addressMarkerInfoContent = 
					'<strong>Search:</strong> ' + address + '<br />' +
					'<strong>Latitude:</strong> ' + results[0].geometry.location.lat() + '<br />' +
					'<strong>Longitude:</strong> ' + results[0].geometry.location.lng() + '<br /><br />' +
					'<input type="button" onclick="javascript: ' + _this.objectId + '.addPoint(new google.maps.LatLng(' + results[0].geometry.location.toUrlValue() + ')); return false;" value="Set Marker" /">';
				if (_this.addressMarker){
					_this.addressMarker.setPosition(results[0].geometry.location);
					_this.addressMarkerInfo.setContent(addressMarkerInfoContent);
					google.maps.event.trigger(_this.addressMarker, 'click');
				} else {
					_this.addressMarkerOptions.map = _this.map;
					_this.addressMarkerOptions.position = results[0].geometry.location;
					_this.addressMarkerOptions.icon = _this.markerIcon.address
					_this.addressMarker = new google.maps.Marker(_this.addressMarkerOptions);
					_this.addressMarkerInfo = new google.maps.InfoWindow({
						content: addressMarkerInfoContent
					});
					google.maps.event.addListener(_this.addressMarker, 'click', function() {
						_this.addressMarkerInfo.open(_this.map, _this.addressMarker);
					});
					google.maps.event.trigger(_this.addressMarker, 'click');
				}
				_this.map.setCenter(results[0].geometry.location);
			} else {
				alert('Error Geocode was not successful for the following reason: ' + status);
			}
		});
	},

	/**
	 * Returns a google.maps.LatLng object by given lat,lng string.
	 *
	 * @param string coordinates
	 * @return google.maps.LatLng
	 */
	getLatLng: function(coordinates){
		var lat = coordinates.split(',')[0];
		var lng = coordinates.split(',')[1];
		return new google.maps.LatLng(lat, lng);
	},

	/**
	 * Returns an array of google.maps.LatLng objects by given lat,lng string.
	 *
	 * @param mixed coordinates
	 * @return array
	 */
	getLatLngArray: function(coordinates){
		if (coordinates instanceof google.maps.LatLng) return [coordinates];
		var coordinates = coordinates.split("\n");
		var latLngs = [];
		Ext.each(coordinates, function(coordinate, index){
			if (coordinate){
				latLngs.push(this.getLatLng(coordinate));
			}
		}, this);
		return latLngs;
	}
});