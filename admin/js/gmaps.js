function initMap() {

    var map;
    var arrMarkers = {};
    var bounds;
    var locationCount;
    var mapOptions;
    var infoWindow = null;
    var defaultZoom = 15;
    var mapElementId = 'tt_lc_map';
    var mapElement = document.getElementById(mapElementId);
    var locations = list_loc.list_json;

    mapOptions = {
        zoom: defaultZoom,
        zoomControl: true,
        disableDoubleClickZoom: false,
        mapTypeControl: false,
        panControl: false,
        scaleControl: false,
        scrollwheel: false,
        streetViewControl: false,
        draggable: true,
        overviewMapControl: false,
        mapTypeId: google.maps.MapTypeId.ROADMAP,
    };
    if (jQuery("#loc_map_list_container").length) {
        map = new google.maps.Map(mapElement, mapOptions);
        var geocoder = new google.maps.Geocoder();
        bounds = new google.maps.LatLngBounds();
        infoWindow = new google.maps.InfoWindow({content: "Loading content..."});
        locationCount = 0;
        for (i = 0; i < locations.length; i++) {
            var address = locations[i][1] + '+' + locations[i][2] + ',' + locations[i][3] + '+' + locations[i][4];
            geocoder.geocode({'address': address}, onGeocodeComplete(i));
        }

        google.maps.event.addDomListener(window, 'resize', function () {
            var center = map.getCenter();
            google.maps.event.trigger(map, "resize");
            map.setCenter(center);
        });

        function onGeocodeComplete(i) {

            var geocodeCallBack = function (results, status) {
                if (status == google.maps.GeocoderStatus.OK) {
                    var windowContent = '<div>' +
                        '<p><strong>' + locations[i][0] + '</strong><br>' +
                        locations[i][1] + '<br>' +
                        locations[i][3] + ', ' + locations[i][4] + ' ' + locations[i][5] + '</p>' +
                        '</div>';
                    var id = locations[i][6];
                    var marker = new google.maps.Marker({
                        position: results[0].geometry.location,
                        map: map,
                        html: windowContent,
                        title: locations[i][0],
                        id: id,
                    });
                    google.maps.event.addListener(marker, 'click', function () {
                        showInfoWindow(this);
                    });

                    arrMarkers[id] = marker;

                    jQuery('.tt_list_item').on('click', function () {

                        jQuery('.tt_list_item').removeClass('active');
                        jQuery(this).addClass('active');
                        var markerID = this.id.replace(/[^\d.]/g, '');
                        showInfoWindow(arrMarkers[markerID]);
                    });
                    extendBounds(results[0].geometry.location);
                } else {
                    window.log('Location geocoding has failed: ' + google.maps.GeocoderStatus);
                    mapElement.style.display = 'none';
                }
            };
            return geocodeCallBack;
        }

        function showInfoWindow(marker) {
            infoWindow.setOptions({
                content: marker.html,
                pixelOffset: marker.window_offset
            });
            infoWindow.open(map, marker);
        }

        function extendBounds(latlng) {
            ++locationCount;
            bounds.extend(latlng);

            if (locationCount == locations.length) {
                map.fitBounds(bounds);
                var currentZoom = map.getZoom();

                if (currentZoom > mapOptions.zoom) {
                    map.setZoom(mapOptions.zoom);
                }

                if (currentZoom >= 0) {
                    map.setZoom(9);
                }

            }
        }
    }

}


