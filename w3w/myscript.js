        function myMap() {
            var mapProp = {
                center: new google.maps.LatLng(24.8044055, 46.6031711),
                zoom: 14,
            };
            var map = new google.maps.Map(document.getElementById("googleMap"), mapProp);
            var marker = new google.maps.Marker({
                map: map
            });

            google.maps.event.addListener(map, 'click', function (event) {
                var latlng = new google.maps.LatLng(event.latLng.lat(), event.latLng.lng());
                marker.setPosition(latlng);
                document.getElementById('lat').value = event.latLng.lat();
                document.getElementById('lng').value = event.latLng.lng();
            });
            init();
        }

        function init() {
            var options = {
                types: ['(cities)'],
                componentRestrictions: {
                    country: "sa"
                }
            };

            var input = document.getElementById('locationTextField');
            var autocomplete = new google.maps.places.Autocomplete(input, options);
        }
