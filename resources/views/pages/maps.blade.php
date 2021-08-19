@extends('adminlte::page') 

@section('title', 'Pelacakan') 

@section('content_header')
<h1>Pelacakan</h1>
@stop

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            {{-- <div id="floating-panel">
                <input onclick="clearMarkers();" type="button" value="Hide Markers" />
                <input onclick="showMarkers();" type="button" value="Show All Markers" />
                <input onclick="deleteMarkers();" type="button" value="Delete Markers" />
            </div> --}}
            <div id="map"></div>
        </div>
    </div>
</div>
@stop

@section('css')
{{-- <link rel="stylesheet" href="/css/admin_custom.css" /> --}}
<style type="text/css">
    /* Set the size of the div element that contains the map */
    #map {
        height: 75vh;
        width: 100%;
        border-radius: 5px;
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
{{-- <script>
    // Initialize and add the map
    function initMap() {
        // The location of depok
        const depok = { lat: -6.3648792, lng: 106.8283323 };
        // The map, centered at depok
        const map = new google.maps.Map(document.getElementById("map"), {
            zoom: 15,
            center: depok,
        });
        // const marker = new google.maps.Marker({
        //     position: depok,
        //     map: map,
        // });
    }
</script> --}}
<script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBKE_d1Aq4DHl4Lj-SBXsAuNIxvuKIGv7k&callback=initMap&libraries=places,geometry">
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
@stop

@section('js')
<script>
    console.log("Hi!");
</script>
@stop
