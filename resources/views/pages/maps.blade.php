@extends('adminlte::page') 

@section('title', 'Pelacakan') 

@section('content_header')
<h1>Pelacakan</h1>
@stop

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div id="map"></div>
            <!-- Async script executes immediately and must be after any DOM elements used in callback. -->
            <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAyuhSR2JKeiomWn1hEgvrFdLlEoya_imY&callback=initMap&libraries=&v=weekly" async></script>
        </div>
    </div>
</div>
@stop

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css" />
<style type="text/css">
    /* Set the size of the div element that contains the map */
    #map {
        height: 75vh;
        width: 100%;
        border-radius: 5px;
    }
</style>
<script>
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
</script>
@stop

@section('js')
<script>
    console.log("Hi!");
</script>
@stop
