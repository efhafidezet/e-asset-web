<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        #map {
            height: 100%;
        }

        html,
        body {
            height: 100%;
            margin: 0;
            padding: 0;
        }

        #floating-panel {
            position: absolute;
            top: 10px;
            right: 1%;
            z-index: 5;
            background-color: #fff;
            border: 1px solid #999;
            text-align: center;
        }

    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>

<body>
    <div id="floating-panel">
        <input onclick="clearMarkers();" type="button" value="Hide Markers" />
        <input onclick="showMarkers();" type="button" value="Show All Markers" />
        <input onclick="deleteMarkers();" type="button" value="Delete Markers" />
    </div>
    <div id="map"></div>
    <script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAyuhSR2JKeiomWn1hEgvrFdLlEoya_imY&callback=initMap&libraries=places,geometry">
    </script>
    <script>
        // var locationGlobal = [
        //     // ['Bondi Beach', -6.372998, 106.834803, 4],
        //     // ['Coogee Beach', -33.923036, 151.259052, 5],
        //     // ['Cronulla Beach', -34.028249, 151.157507, 3],
        //     // ['Manly Beach', -33.80010128657071, 151.28747820854187, 2],
        //     // ['Maroubra Beach', -33.950198, 151.259302, 1]
        // ];
        let locationGlobal = [];

        let map;
        let markers = [];

        function initMap() {
            const haightAshbury = {
                // lat: -6.2,
                // lng: 106.816666
                lat: -6.343,
                lng: 106.8334
            };
            map = new google.maps.Map(document.getElementById("map"), {
                zoom: 10,
                center: haightAshbury,
                mapTypeId: "roadmap",
            });
            // This event listener will call addMarker() when the map is clicked.
            // map.addListener("click", (event) => {
            //     addMarker(event.latLng);
            // });
            // Adds a marker at the center of the map.
            setInterval(function () {
                deleteMarkers();
            }, 2000);
            setInterval(function () {
                // alert("Hello");
                for (let index = 0; index < locationGlobal.length; index++) {
                    addMarker(locationGlobal[index]);
                    if (index == 1) {
                        // deleteMarkers();
                        // console.log('1');
                    }
                }
                // console.log(locationGlobal);
            }, 1000);
        }

        // Adds a marker to the map and push to the array.
        function addMarker(location) {
            var img = {
                url: "http://143.198.219.211/dev/img/google-maps-logo.png", // url
                scaledSize: new google.maps.Size(50, 50), // scaled size
                origin: new google.maps.Point(0,0), // origin
                anchor: new google.maps.Point(0, 0) // anchor
            };
            const marker = new google.maps.Marker({
                position: location,
                map: map,
                icon: img,
            });
            markers.push(marker);
        }

        // Sets the map on all markers in the array.
        function setMapOnAll(map) {
            for (let i = 0; i < markers.length; i++) {
                markers[i].setMap(map);
            }
        }

        // Removes the markers from the map, but keeps them in the array.
        function clearMarkers() {
            setMapOnAll(null);
        }

        // Shows any markers currently in the array.
        function showMarkers() {
            setMapOnAll(map);
        }

        // Deletes all markers in the array by removing references to them.
        function deleteMarkers() {
            clearMarkers();
            markers = [];
            locationGlobal = [];
        }


        // function initMap() {

        //     var map = new google.maps.Map(document.getElementById('map'), {
        //         zoom: 10,
        //         center: new google.maps.LatLng(-6.372998, 106.834803),
        //         mapTypeId: google.maps.MapTypeId.ROADMAP
        //     });

        //     var infowindow = new google.maps.InfoWindow();

        //     var locations = [
        //         ['Maroubra Beach', -33.950198, 151.259302, 1]
        //     ];

        //     setInterval(function() {
        //         locations = locationGlobal;
        //         var marker, i;

        //         // for (var i = 0; i < 2; i++) {
        //         //     marker[i].setMap(null);
        //         // }

        //         for (i = 0; i < locations.length; i++) {
        //             marker = new google.maps.Marker({
        //                 position: new google.maps.LatLng(locations[i][1], locations[i][2]),
        //                 map: map
        //             });

        //             google.maps.event.addListener(marker, 'click', (function (marker, i) {
        //                 return function () {
        //                     infowindow.setContent(locations[i][0]);
        //                     infowindow.open(map, marker);
        //                 }
        //             })(marker, i));
        //             console.log(i);
        //         }
        //     }, 1000)
        // }

        window.addEventListener('load', function () {
            var xhr = null;

            getXmlHttpRequestObject = function () {
                if (!xhr) {
                    // Create a new XMLHttpRequest object 
                    xhr = new XMLHttpRequest();
                }
                return xhr;
            };

            function updateLiveData() {
                var trackID = {{$id}};
                var url = "{{url('api/getTrackedLocation')}}/"+trackID;
                xhr = getXmlHttpRequestObject();
                xhr.onreadystatechange = evenHandler;
                // asynchronous requests
                xhr.open("GET", url, true);
                // Send the request over the network
                xhr.send(null);
            }

            updateLiveData();

            function evenHandler() {
                // Check response is ready or not
                if (xhr.readyState == 4 && xhr.status == 200) {
                    // dataDiv = document.getElementById('liveData');
                    // Set current data text
                    // dataDiv.innerHTML = xhr.responseText;
                    jsondata = JSON.parse(xhr.responseText);
                    // console.log(jsondata[1].latitude);
                    // for (let index = 0; index < jsondata.length; index++) {
                    //     locationGlobal.push([jsondata[index].track_time, jsondata[index].latitude, jsondata[
                    //             index]
                    //         .longitude, 4
                    //     ]);
                    // }
                    // locationGlobal = [];
                    for (let index = 0; index < jsondata.length; index++) {
                        // locationGlobal.push({
                        //     lat: jsondata[index].latitude,
                        //     lng: jsondata[index].longitude
                        // }]);
                        locationGlobal.push({
                            lat: Number(jsondata[index].latitude),
                            lng: Number(jsondata[index].longitude)
                        });
                    }
                    // locationGlobal = [
                    //     [jsondata[0].track_time, jsondata[0].latitude, jsondata[0].longitude]
                    // ];
                    // console.log(locations);
                    // console.log(jsondata.length);
                    // Update the live data every 1 sec
                    // updateLiveData();
                    // setTimeout(updateLiveData(), 100000000);
                    setTimeout(updateLiveData, 1000);
                }
            }
        });

    </script>
</body>

</html>








{{-- <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <style>
        #map {
            height: 100%;
        }

        html,
        body {
            height: 100%;
            margin: 0;
            padding: 0;
        }

        #floating-panel {
            position: absolute;
            top: 10px;
            right: 1%;
            z-index: 5;
            background-color: #fff;
            border: 1px solid #999;
            text-align: center;
        }

    </style>
</head>

<body>
    <div id="floating-panel">
        <b>Start1: </b>
        <input tye="text" id="start1" value="Mumbai"><!-- Starting Location -->
        <b>End1: </b>
        <input type="text" id="end1" value="Delhi"><!-- Ending Location -->
    </div>
    <div id="map"></div>
    <script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAyuhSR2JKeiomWn1hEgvrFdLlEoya_imY&callback=initMap&libraries=places,geometry">
    </script>

    <script>
        function calcDistance(p1, p2) { //p1 and p2 in the form of google.maps.LatLng object
            return (google.maps.geometry.spherical.computeDistanceBetween(p1, p2) / 1000).toFixed(
            3); //distance in KiloMeters
        }

        function getLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(showPosition, showError);
            } else {
                alert("Geolocation is not supported by this browser.");
            }
        }

        function showPosition(position) {
            alert("Latitude: " + position.coords.latitude + " Longitude: " + position.coords.longitude);
        }

        function showError(error) {
            switch (error.code) {
                case error.PERMISSION_DENIED:
                    alert("User denied the request for Geolocation.");
                    break;
                case error.POSITION_UNAVAILABLE:
                    alert("Location information is unavailable.");
                    break;
                case error.TIMEOUT:
                    alert("The request to get user location timed out.");
                    break;
                case error.UNKNOWN_ERROR:
                    alert("An unknown error occurred.");
                    break;
            }
        }

        function initMap() {

            var map = new google.maps.Map(document.getElementById('map'), {
                zoom: 10,
                center: {
                    lat: 18.9965041,
                    lng: 72.8194209
                }
            });

            var waypts = []; //origin to destination via waypoints
            //waypts.push({location: 'indore', stopover: true});

            function continuouslyUpdatePosition(
            location) { //Take current location from location.php and set marker to that location
                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function () {
                    if (this.readyState == 4 && this.status == 200) {
                        var pos = JSON.parse(this.responseText);
                        location.setPosition(new google.maps.LatLng(pos.lat, pos.lng));
                        setTimeout(function () {
                            continuouslyUpdatePosition(location);
                        }, 5000);
                    }
                };
                xhttp.open("GET", "location.php", true);
                xhttp.send();
            }

            /* Distance between p1 & p2
            var p1 = new google.maps.LatLng(45.463688, 9.18814);
            var p2 = new google.maps.LatLng(46.0438317, 9.75936230000002);
            alert(calcDistance(p1,p2)+" Kilimeters");
            */

            //Make marker at any position in form of {lat,lng}
            function makeMarker(position /*, icon*/ ) {
                var marker = new google.maps.Marker({
                    position: position,
                    map: map,
                    /*animation: google.maps.Animation.DROP,*/
                    /*icon: icon,*/
                });
                return marker;
            }

            var icons = {
                end: new google.maps.MarkerImage(
                    'http://icons.iconarchive.com/icons/icons-land/vista-map-markers/32/Map-Marker-Push-Pin-1-Left-Pink-icon.png'
                    ),
                start: new google.maps.MarkerImage(
                    'http://icons.iconarchive.com/icons/icons-land/vista-map-markers/32/Map-Marker-Push-Pin-1-Left-Chartreuse-icon.png'
                    )
            };

            //Show suggestions for places, requires libraries=places in the google maps api script link
            var autocomplete1 = new google.maps.places.Autocomplete(document.getElementById('start1'));
            var autocomplete2 = new google.maps.places.Autocomplete(document.getElementById('end1'));

            var directionsService1 = new google.maps.DirectionsService;
            var directionsDisplay1 = new google.maps.DirectionsRenderer({
                polylineOptions: {
                    strokeColor: "red"
                }, //path color
                //draggable: true,// change start, waypoints and destination by dragging
                /* Start and end marker with same image
                markerOptions : {icon: 'http://icons.iconarchive.com/icons/icons-land/vista-map-markers/32/Map-Marker-Push-Pin-1-Left-Pink-icon.png'},
                */
                //suppressMarkers: true
            });
            directionsDisplay1.setMap(map);
            var onChangeHandler1 = function () {
                calculateAndDisplayRoute(directionsService1, directionsDisplay1, $('#start1'), $('#end1'));
            };
            $('#start1,#end1').change(onChangeHandler1);

            function calculateAndDisplayRoute(directionsService, directionsDisplay, start, end) {
                directionsService.route({
                    origin: start.val(),
                    destination: end.val(),
                    waypoints: waypts,
                    travelMode: 'DRIVING'
                }, function (response, status) {
                    if (status === 'OK') {
                        directionsDisplay.setDirections(response);
                        var leg = response.routes[0].legs[0];
                        // Move marker along path from A to B
                        var markers = [];
                        for (var i = 0; i < leg.steps.length; i++) {
                            var marker = makeMarker(leg.steps[i].start_location);
                            markers.push(marker);
                            marker.setMap(null);
                        }
                        tracePath(markers, 0);

                        var location = makeMarker(leg.steps[0].start_location);
                        continuouslyUpdatePosition(location);

                    } else {
                        window.alert('Directions request failed due to ' + status);
                    }
                });
            }

            function tracePath(markers, index) { // move marker along path from A to B
                if (index == markers.length) return;
                markers[index].setMap(map);
                setTimeout(function () {
                    markers[index].setMap(null);
                    tracePath(markers, index + 1);
                }, 500);
            }

            calculateAndDisplayRoute(directionsService1, directionsDisplay1, $('#start1'), $('#end1'));
        }

    </script>
</body>

</html> --}}
