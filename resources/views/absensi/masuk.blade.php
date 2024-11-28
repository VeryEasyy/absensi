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
    <title>Absensi</title>
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
        <div class="pageTitle">Absensi</div>
        <div class="right"></div>
    </div>
    <style>
        /* Responsive CSS */
        body {
            margin: 0;
            font-family: Arial, sans-serif;
        }

        #mycamera,
        #mycamera video {
            display: block;
            width: 100% !important;
            margin: auto;
            height: auto;
            border-radius: 15px;
        }

        #mycamera {
            height: auto;
        }

        #map {
            display: none;
            height: 180px;
            width: 100%;
        }

        #takeabsen {
            margin-top: 10px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        /* Media Queries for responsiveness */
        @media (max-width: 768px) {

            #map {
                height: 180px;
            }

            #takeabsen {
                font-size: 14px;
            }
        }

        @media (max-width: 480px) {
            #map {
                height: 180px;
            }

            #takeabsen {
                font-size: 12px;
              
            }
        }
    </style>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"/>
@endsection

@section('content')
    <<div class="row g-0" style="margin-top: 70px">
        <div class="col">
            <input type="hidden" name="lokasi" id="lokasi">
            <div id="mycamera"></div>
        </div>    
    </div>
    <div class="row g-0">
        <div class="col">
            @if ($cek > 0)
                <button type="button" id="takeabsen" class="btn btn-danger btn-block mb-0">
                    <ion-icon name="camera-outline"></ion-icon>
                    Absen Pulang
                </button>
            @else
                <button type="button" id="takeabsen" class="btn btn-primary btn-block mb-0">
                    <ion-icon name="camera-outline"></ion-icon>
                    Absen Masuk
                </button>
            @endif
        </div>
    </div>
    <div class="row g-0 mt-2">
        <div class="col">
            <div id="map"></div> 
        </div>
    </div>
@endsection

@push('myjs')
<script>
    Webcam.set({
    width: 640,
    height: 480,
    image_format: 'jpeg',
    jpeg_quality: 90,
    constraints: {
        video: true
    }
});

    Webcam.attach('#mycamera');

    var lokasi = document.getElementById('lokasi');
    if(navigator.geolocation){
                navigator.geolocation.getCurrentPosition(successCallback, errorCallback);
            }

            function successCallback(position){
                lokasi.value = position.coords.latitude + "," + position.coords.longitude;
                
                var map = L.map('map').setView([position.coords.latitude, position.coords.longitude], 19);
                
                L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', 
                {
                    maxZoom: 23,
                    
                }).addTo(map);
                var marker = L.marker([position.coords.latitude, position.coords.longitude]).addTo(map);
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

            $('#takeabsen').click(function(e){
                Webcam.snap(function(uri){
                    image = uri;
                });
                var lokasi = $('#lokasi').val();
                $.ajax({
                    type: 'POST',
                    uri: '/absensi/store',
                    data: {
                        _token: "{{ csrf_token() }}",
                        image:image,
                        lokasi:lokasi
                    },
                    cache: false,
                    success: function(respond){
                        var status = respond.split("|");
                        if(status[0] == "success"){
                            Swal.fire({
                                title: 'Berhasil',
                                text: status[1],
                                icon: 'success',
                            })
                            setTimeout("location.href='/dashboard'", 1000);
                        }else{
                            Swal.fire({
                                title: 'Absen Gagal!',
                                text: status[1],
                                icon: 'error',
                            })
                            setTimeout("location.href='/dashboard'", 1000);
                        }
                    }

                });
            });
</script>
@endpush
