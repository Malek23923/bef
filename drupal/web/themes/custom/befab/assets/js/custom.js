/**
 * @file
 * Attaches behaviors for the custom Google Maps.
 */

(function ($, Drupal) {

    /**
     * Initializes the map.
     */
    function init(geofield, title) {

        $.each(geofield, function (index, value) {

            var title = drupalSettings.title[index];
            var p = value.replace('POINT', '');
            var p = p.replace('(', '');
            var p = p.replace(')', '');
            var p = p.split(' ');
            var point = {lat: parseFloat(p[1]), lng: parseFloat(p[0])};
            console.log('my-map-' + index);
            var map = new google.maps.Map(document.getElementById('my-map-' + index), {
                center: point,
                scrollwheel: true,
                zoom: 12
            });

            var infowindow = new google.maps.InfoWindow({
                content: title
            });

            var marker = new google.maps.Marker({
                position: point,
                map: map,
                title: title
            });

            marker.addListener('click', function () {
                infowindow.open(map, marker);
            });

        });

    }

    Drupal.behaviors.customMapBehavior = {
        attach: function (context, settings) {
            init(settings.geofield, settings.title);
        }
    };

})(jQuery, Drupal);