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
    <title>Data Izin & Sakit</title>
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
        <div class="pageTitle">Pengajuan Data</div>
        <div class="right"></div>
    </div>
@endsection
@if ($combinedData->isEmpty())
    <div class="alert alert-outline-warning">
        <b>Pengajuan Data Belum Ada</b>
    </div>
@endif
@section('content')
    <div class="row" style="margin-top: 4rem;">
        <div class="col" style="margin-top: 4rem">
            <ul class="listview image-listview">
                @foreach ($combinedData as $d)
                <li>
                    <div class="item">
                        <div class="in">
                            <div>
                                @if(isset($d->tgl_izin))
                                    <b>{{ date("d-m-Y", strtotime($d->tgl_izin)) }}
                                        ({{ $d->status == "s" ? "Sakit" : "Izin" }})
                                    </b><br>
                                @elseif(isset($d->tgl_mulai))
                                    <b>{{ date("d-m-Y", strtotime($d->tgl_mulai)) }} - {{ date("d-m-Y", strtotime($d->tgl_selesai)) }}
                                        ({{ $d->tipe_dinas }})
                                    </b><br>
                                    <i>{{ date("H:i:s", strtotime($d->waktu_mulai)) }} - {{ date("H:i:s", strtotime($d->waktu_selesai)) }} 
                                    </i><br>
                                @endif
                                <small class="text-muted">{{ $d->keterangan }}</small>
                            </div>
                            @if($d->status_approved == 0)
                                <span class="badge bg-warning">Menunggu</span>
                            @elseif($d->status_approved == 1)
                                <span class="badge bg-success">Disetujui</span>
                            @elseif($d->status_approved == 2)
                                <span class="badge bg-danger">Ditolak</span>
                            @endif
                        </div>
                    </div>
                </li>
                @endforeach
            </ul>
        </div>
    </div>
@endsection
