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
    <title>Form Izin</title>
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
        <div class="pageTitle">Form Izin & Sakit</div>
        <div class="right"></div>
    </div>
    <style>
        label{
            margin-left: 5px;
            font-size: 15px;
        }
        #datepicker{
            width:100%; 
            margin: 0px 10px 10px 0px;
        }
        #datepicker > span:hover{
            cursor: pointer;
        }
    </style>
@endsection
@section('content')
    <div class="row" style="margin-top: 4rem">
        <div class="col">
            <form action="" method="POST" id="formizin" style="margin-top: 3rem">
                @csrf
                <div class="input-wrapper">
                    <label for="tgl">Pilih Tanggal :</label>
                </div>
                <div id="datepicker" class="input-group date boxed mb-1" >
                    <input class="form-control" type="text" name="tgl_izin" id="tgl_izin" readonly/>
                    <span class="input-group-addon ">
                        <i class="glyphicon glyphicon-calendar"></i>
                    </span>
                </div>
                <div class="form-group boxed">
                    <div class="input-wrapper">
                       <select name="status" id="status" class="form-control">
                            <option value="">Izin / Sakit</option>
                            <option value="i">izin</option>
                            <option value="s">sakit</option>
                       </select>
                    </div>
                </div>
                <div class="form-group boxed">
                    <div class="input-wrapper">
                        <textarea name="ket" id="ket" cols="20" rows="5" class="form-control" placeholder="Keterangan"></textarea>
                    </div>
                </div>
                <div class="form-group boxed">
                    <div class="input-wrapper">
                        <button type="submit" class="btn btn-primary btn-block" >
                            <ion-icon name="send-outline" style="font-size: 15px"></ion-icon>
                            Kirim
                        </button>
                    </div>
                </div>
                </div>
            </form>
        </div>
    </div>
    <div class="row">
        <div class="col" style="color: black">
            @php
                $messagesucces = Session::get('success');
                $messageerror = Session::get('error');
                $messagewarning = Session::get('warning');
            @endphp
             @if (Session::get('success'))
             <div class="alert alert-success" style="background-color:lightgreen">
                 {{ $messagesucces }}
             </div>
             <script>
                setTimeout(function() {
                    window.location.href = '/absensi/dataizin';
                }, 2000); 
            </script>
            @endif
            @if (Session::get('error'))
                <div class="alert alert-error">
                    {{ $messageerror }}
                </div>
                <script>
                    setTimeout(function() {
                        window.location.href = '/absensi/izin';
                    }, 2000); 
                </script>
            @endif
            @if (Session::get('warning'))
             <div class="alert alert-warning" style="background-color: orange">
                 {{ $messagewarning }}
             </div>
             <script>
                setTimeout(function() {
                    window.location.href = '/dashboard';
                }, 2000); 
            </script>
            @endif
        </div>
    </div>
    {{-- <div class="row" style="margin-top: 4rem">
        <div class="col">
            @php
                $messagesucces = Session::get('success');
                $messageerror = Session::get('error');
                $messageinfo = Session::get('info');
            @endphp
            @if (session('info'))
            <div class="alert alert-info">
                {{ $messageinfo}}
            </div>
            @endif
            @if (Session::get('success'))
             <div class="alert alert-success">
                 {{ $messagesucces }}
             </div>
            @endif
            @if (Session::get('error'))
                <div class="alert alert-error">
                    {{ $messageerror }}
                </div>
            @endif
        </div>
    </div> --}}
@endsection

@push('myjs')
    <script>
        $(function () {
            $("#datepicker").datepicker({ 
                autoclose: true, 
                todayHighlight: true
            }).datepicker('update', new Date());
        });

        $("#formizin").submit(function(){
            var tgl_izin = $("#tgl_izin").val();
            var status = $("#status").val();
            var ket = $("#ket").val();

            if(tgl_izin == ""){
                Swal.fire({
                    title: 'Info',
                    text: 'Tanggal Harus Diisi',
                    icon: 'warning',
                })
                return false;
            } else if (status == ""){
                Swal.fire({
                    title: 'Info',
                    text: 'Data Izin / Sakit Harus Diisi',
                    icon: 'warning',
                })
                return false;
            }else if (ket == ""){
                Swal.fire({
                    title: 'Info',
                    text: 'keterangan Harus Diisi',
                    icon: 'warning',
                })
                return false;
            }
            if($cek > 0){
                Swal.fire({
                    title: 'Info',
                    text: 'Anda Sudah Mengirim Data Izin/Sakit',
                    icon: 'error',
                })
                return false;
            }else{
                Swal.fire({
                    title: 'Berhasil',
                    text: 'Berhasil mengirim data izin',
                    icon: 'success',
                })
                return false;
            }
        });

    </script>
@endpush