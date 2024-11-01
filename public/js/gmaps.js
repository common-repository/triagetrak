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
    var locations_list = jQuery("#loc_map_list_container .tt_list_item");

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

        locations_list.each(function (i, obj) {
            var address = jQuery(obj).attr("data-address");
            var id = jQuery(obj).attr("data-id");
            var title = jQuery(obj).attr("data-title");
            geocoder.geocode({'address': address}, onGeocodeComplete(id, address, title));
        });

        google.maps.event.addDomListener(window, 'resize', function () {
            var center = map.getCenter();
            google.maps.event.trigger(map, "resize");
            map.setCenter(center);
        });

        function onGeocodeComplete(id, address, title) {
            return  geocodeCallBack = function (results, status) {
                if (status == google.maps.GeocoderStatus.OK) {
                    var windowContent = '<div>' +
                        '<p><strong>' + title + '</strong><br>' + address + '</p>' +
                        '</div>';
                    var marker = new google.maps.Marker({
                        position: results[0].geometry.location,
                        map: map,
                        html: windowContent,
                        title: title,
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

            if (locationCount === locations_list.length) {
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
