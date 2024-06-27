@extends('layouts.absensi')
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
    <meta http-equiv="Pragma" content="no-cache" />
    <meta http-equiv="Expires" content="0" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, viewport-fit=cover" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="theme-color" content="#000000">
    <title>Lokasi Absensi</title>
    <meta name="description" content="Mobilekit HTML Mobile UI Kit">
    <meta name="keywords" content="bootstrap 4, mobile template, cordova, phonegap, mobile, html" />
    <link rel="icon" type="image/png" href="{{ asset('assets/img/favicon.png') }}" sizes="32x32">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/img/icon/192x192.png') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="manifest" href="__manifest.json">
</head>

@section('header')
    <div class="appHeader bg-primary text-light">
        <div class="left">
            <a href="javascript:;" class="headerButton goBack">
                <ion-icon name="chevron-back-outline"></ion-icon>
            </a>
        </div>
        <div class="pageTitle">Lokasi Absensi</div>
        <div class="right"></div>
    </div>
@endsection

@section('content')
<div class="row" style="margin-top: 70px">
    <div class="col">
        <input type="hidden" name="lokasi" id="lokasi">
    </div>    
</div>
<div class="row">
    <div class="col">
        <div id="map"></div> 
    </div>
</div>
<style>
    #map{
        width: 100%;
        height: 600px;
    }
</style>
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"/>
@endsection

@push('myjs')
<script>
    var lokasi = document.getElementById('lokasi');
    if(navigator.geolocation){
                navigator.geolocation.getCurrentPosition(successCallback, errorCallback);
            }

            function successCallback(position){
                lokasi.value = position.coords.latitude + "," + position.coords.longitude;
                
                var map = L.map('map').setView([position.coords.latitude, position.coords.longitude], 18);
                
                L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', 
                {
                    maxZoom: 23,
                    
                }).addTo(map);
                var marker = L.marker([position.coords.latitude, position.coords.longitude]).addTo(map);
                // [-6.322418883392748, 106.71482286142736]
                var circle = L.circle([position.coords.latitude, position.coords.longitude], {
                    color: 'red',
                    fillColor: '#f03',
                    fillOpacity: 0.5,
                    radius: 50
                }).addTo(map);
            }
            
            function errorCallback(error) {
                console.log(error.message);
            }

           
</script>
@endpush