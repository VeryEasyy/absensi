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
    <title>Data Pengajuan</title>
    <meta name="description" content="Mobilekit HTML Mobile UI Kit">
    <meta name="keywords" content="bootstrap 4, mobile template, cordova, phonegap, mobile, html" />
    <link rel="icon" type="image/png" href="{{ asset('assets/img/favicon.png') }}" sizes="32x32">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/img/icon/192x192.png') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="manifest" href="__manifest.json">
    <style>

        .item{
            color: black;
            display: flex;
            align-items: center;
            text-decoration: none; 
        }
    
        .item ion-icon {
            margin-right: 8px;
        }
      
    </style>
</head>

@section('header')
    <div class="appHeader bg-primary text-light">
        <div class="left">
            <a href="javascript:;" class="headerButton goBack">
                <ion-icon name="chevron-back-outline"></ion-icon>
            </a>
        </div>
        <div class="pageTitle">Data Pengajuan</div>
        <div class="right"></div>
    </div>
@endsection

@section('content')
<div class="row" style="margin-top: 2rem">
    <div class="col">
        <div class="form-group boxed" style="font-size: 18px;">
            <div class="wrapper mt-5">
                <a href="/absensi/formdinas" class="item">
                        <ion-icon name="briefcase-outline" role="img" class="md hydrated" 
                            aria-label="people text outline">
                        </ion-icon>
                        <strong >Dinas Luar</strong>
                </a>
            </div>
            <div class="wrapper mt-2">
                <a href="/absensi/formizin" class="item">
                        <ion-icon  name="document-text-outline" role="img" class="md hydrated"
                            aria-label="key text outline"></ion-icon>
                        <strong >Form Izin & Sakit</strong>
                </a>
            </div>
            <div class="wrapper mt-2">
                <a href="/absensi/historyizin" class="item">
                        <ion-icon name="file-tray-full-outline" role="img" class="md hydrated"
                            aria-label="key text outline"></ion-icon>
                        <strong >History Izin & Sakit</strong>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
