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
    <title>Form Dinas Luar</title>
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
        <div class="pageTitle">Data Dinas Luar</div>
        <div class="right"></div>
    </div>
    <style>
        label{
            margin-left: 10px;
            font-size: 12px;
            color: grey;
        }
        #kirim{
            margin-top: 10px;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        
    </style>
@endsection

@section('content')
    <div class="row" style="margin-top: 4rem">
        <div class="col">
            <form action="" method="POST" id="formdinas" style="margin-top: 3rem">
                @csrf
                <div class="form-group boxed" >
                    <div class="input-wrapper">
                        <label for="tipe">TIPE DINAS LUAR (DL)</label>
                       <select name="tipe" id="tipe" class="form-control">
                            <option value="">Pilih Tipe</option>
                            <option value="Dinas Luar Full">Dinas Luar Full</option>
                            <option value="Dinas Luar, Masuk Kerja">Dinas Luar, Masuk Kerja</option>
                            <option value="Masuk Kerja, Dinas Luar">Masuk Kerja, Dinas Luar</option>
                            <option value="Dinas Luar Dihari Libur">Dinas Luar Dihari Libur</option>
                            <option value="WFH (Work From Home)">WFH (Work From Home)</option>
                       </select>
                    </div>
                </div>
                <div class="form-group boxed">
                    <div class="input-wrapper">
                        <label for="lokasi">ALAMAT LOKASI DINAS</label>
                        <input name="lokasi" id="lokasi" class="form-control" placeholder="Lokasi"></input>
                    </div>
                </div>
                {{-- <div class="form-group boxed">
                    <div class="input-wrapper">
                        <label for="tgl">TANGGAL & WAKTU</label>
                    </div>
                </div> --}}
                <div class="form-group boxed">
                    <div class="row">
                        <div class="col-6">
                            <label for="checkin">Tgl Mulai</label>
                            <div class="form-group input-group">
                                <input class="form-control datepicker" name="checkin" id="checkin">
                                <span class="input-group-addon">
                                    <i class="glyphicon glyphicon-calendar"></i>
                                </span>
                            </div>
                        </div>
                        <div class="col-6">
                            <label for="checkout" >Tgl Selesai</label>
                            <div class="form-group input-group">
                                <input class="form-control datepicker" name="checkout" id="checkout">
                                <span class="input-group-addon">
                                    <i class="glyphicon glyphicon-calendar"></i>
                                </span>
                            </div>
                        </div>
                        <div class="col-6">
                            <label for="timein">Waktu Mulai</label>
                            <div class="form-group input-group">
                                <input type="time" class="form-control timepicker" name="timein" id="timein">
                                <span class="input-group-addon">
                                    <i class="glyphicon glyphicon-time"></i>
                                </span>
                            </div>
                        </div>
                        <div class="col-6">
                            <label for="timeout">Waktu Selesai</label>
                            <div class="form-group input-group">
                                <input type="time" class="form-control timepicker" name="timeout" id="timeout">
                                <span class="input-group-addon">
                                    <i class="glyphicon glyphicon-time"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group boxed">
                    <div class="row">
                        <div class="col">
                            <label for="ket">KETERANGAN</label>
                        </div>
                    </div>
                    <div class="input-wrapper">
                        <textarea name="ket" id="ket" cols="20" rows="5" class="form-control" placeholder="Keterangan"></textarea>
                    </div>
                </div>
               
                <div class="form-group boxed">
                    <div class="input-wrapper">
                        <button type="submit"  id="kirim" class="btn btn-primary btn-block">
                            <ion-icon name="send-outline" style="font-size: 17px;"></ion-icon>
                            Kirim Pengajuan
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
             <div class="alert alert-success" style="background-color: lightgreen">
                 {{ $messagesucces }}
             </div>
             <script>
                setTimeout(function() {
                    window.location.href = '/absensi/dataizin';
                }, 2000); 
            </script>
            @endif
            @if (Session::get('error'))
                <div class="alert alert-error" style="background-color: red">
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
@endsection

@push('myjs')
<script>
          $(function () {
            $("#checkin").datepicker({ 
                autoclose: true, 
                todayHighlight: true
            }).datepicker('update', new Date());

            $("#checkout").datepicker({ 
                autoclose: true, 
                todayHighlight: true
            });
        });

        $("#formdinas").submit(function(){
            var tipe = $("#tipe").val();
            var lokasi = $("#lokasi").val();
            var tgl_mulai = $('#checkin').val();
            var tgl_selesai = $('#checkout').val();
            var waktu_mulai = $('#timein').val();
            var waktu_selesai = $('#timeout').val();
            var ket = $("#ket").val();
            
            if(tipe == ""){
                Swal.fire({
                    title: 'Info',
                    text: 'Tipe Harus Diisi',
                    icon: 'warning',
                })
                return false;
            } else if (lokasi == ""){
                Swal.fire({
                    title: 'Info',
                    text: 'Alamat Harus Diisi',
                    icon: 'warning',
                })
                return false;
            }else if (tgl_mulai == ""){
                Swal.fire({
                    title: 'Info',
                    text: 'Tgl Mulai Harus Diisi',
                    icon: 'warning',
                })
                return false;
            } else if (tgl_selesai == ""){
                Swal.fire({
                    title: 'Info',
                    text: 'Tgl Selesai Harus Diisi',
                    icon: 'warning',
                })
                return false;
            } else if (waktu_mulai == ""){
                Swal.fire({
                    title: 'Info',
                    text: 'Waktu Mulai Harus Diisi',
                    icon: 'warning',
                })
                return false;
            } else if (waktu_selesai == ""){
                Swal.fire({
                    title: 'Info',
                    text: 'Waktu Selesai Harus Diisi',
                    icon: 'warning',
                })
                return false;
            } else if (ket == ""){
                Swal.fire({
                    title: 'Info',
                    text: 'Keterangan Harus Diisi',
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
