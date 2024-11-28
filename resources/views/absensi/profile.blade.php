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
    <title>Profile</title>
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
        <div class="pageTitle">Profile</div>
        <div class="right"></div>
    </div>
@endsection

@section('content')
    {{-- <div class="form-group boxed" >
        <div id="user-detail">
                <div class="avatar" style="margin-top: 5rem">
                    @if (!empty(Auth::guard('karyawan')->user()->foto))
                        @php
                            $path = Storage::url('uploads/guru/'.Auth::guard('karyawan')->user()->foto);
                        @endphp
                        <img src="{{ url($path) }}" alt="avatar" class="imaged w64 rounded" style="height: 60px">
                    @else
                        <img src="assets/img/sample/avatar/avatar1.jpg" alt="avatar" class="imaged w64 rounded">
                    @endif
                </div>
                <div id="user-info" style="margin-top: 4rem">
                <b><h2 id="user-name" style="color:black">{{ Auth::guard('karyawan')->user()->nama }}</h2>
                    <span id="user-role" style="color:black">{{ Auth::guard('karyawan')->user()->jabatan }}</span></b>
                </div>
        </div>
        <div class="wrapper1">
            <a href="/editprofile" class="item">
                    <ion-icon name="people-outline" role="img" class="md hydrated"
                        aria-label="people text outline"></ion-icon>
                    <strong >Edit Profile</strong>
            </a>
        </div>
        </div>
</div> --}}

<div class="container">
    <div class="main-body">
          <div class="row gutters-sm mt-4">
            <div class="col-md-4 mb-3 mt-5">
              <div class="card">
                <div class="card-body">
                  <div class="d-flex flex-column align-items-center text-center">
                    @if (!empty(Auth::guard('karyawan')->user()->foto))
                        @php
                            $path = Storage::url('uploads/guru/'.Auth::guard('karyawan')->user()->foto);
                        @endphp
                        <img src="{{ url($path) }}" alt="admin" class="rounded-circle" width="150">
                    @else
                        <img src="assets/img/sample/avatar/avatar1.jpg" alt="admin" class="rounded-circle" width="150">
                    @endif
                    <div class="mt-3">
                      <h4>{{ Auth::guard('karyawan')->user()->nama }}</h4>
                      <h5>{{ Auth::guard('karyawan')->user()->nuptk }}</h5>
                      <p class="text-secondary mb-1">{{ Auth::guard('karyawan')->user()->jabatan }}</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-8 mt-5">
              <div class="card mb-3">
                <div class="card-body">
                  <div class="row g-2">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Full Name</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                        {{ Auth::guard('karyawan')->user()->nama }}
                    </div>
                  </div>
                  <hr>
                  <div class="row g-2">
                    <div class="col-sm-3">
                      <h6 class="mb-0">NUPTK</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                        {{ Auth::guard('karyawan')->user()->nuptk }}
                    </div>
                  </div>
                  <hr>
                  <div class="row g-2">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Phone</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                        {{ Auth::guard('karyawan')->user()->no_hp }}
                    </div>
                  </div>
                  <hr>
                  <hr>
                  <div class="row g-2">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Jabatan</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                        {{ Auth::guard('karyawan')->user()->jabatan }}
                    </div>
                  </div>
                  <hr>
                  <div class="row g-2 mb-2">
                    <div class="col-sm-12">
                        <a class="btn btn-primary d-flex align-items-center justify-content-center gap-2" href="/editprofile">
                            <ion-icon name="people-outline" role="img" class="md hydrated" aria-label="people text outline"></ion-icon>
                            <span>Edit Profile</span>
                        </a>
                    </div>
                </div>
                
                </div>
              </div>
            </div>
          </div>

        </div>
    </div>
@endsection
