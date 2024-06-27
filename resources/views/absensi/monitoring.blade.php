@extends('layouts.admin.template')
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <title>Monitoring Absensi Guru</title>
    <!-- CSS files -->
    <link href="{{ asset('tabler/dist/css/tabler.min.css?1692870487') }}" rel="stylesheet"/>
    <link href="{{ asset('tabler/dist/css/tabler-flags.min.css?1692870487') }}" rel="stylesheet"/>
    <link href="{{ asset('tabler/dist/css/tabler-payments.min.css?1692870487') }}" rel="stylesheet"/>
    <link href="{{ asset('tabler/dist/css/tabler-vendors.min.css?1692870487') }}" rel="stylesheet"/>
    <link href="{{ asset('tabler/dist/css/demo.min.css?1692870487') }}" rel="stylesheet"/>
    <style>
      @import url('https://rsms.me/inter/inter.css');
      :root {
      	--tblr-font-sans-serif: 'Inter Var', -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;
      }
      body {
      	font-feature-settings: "cv03", "cv04", "cv11";
      }
      table {
        width: 100%;
        border-collapse: collapse;
      }
      thead {
        background-color: #f8f9fa;
      }
      th, td {
        padding: 12px 15px;
        border: 1px solid #dee2e6;
      }
      th {
        background-color: cadetblue;
        color: #ffffff;
        font-weight: 600;
      }
      tbody tr:nth-child(odd) {
        background-color: #f2f2f2;
      }
      tbody tr:hover {
        background-color: #e9ecef;
      }
      .table-wrapper {
        overflow-x: auto;
      }
    </style>
  </head>

  @section('content')
  <div class="page-header d-print-none">
    <div class="container-xxl">
      <div class="row g-2 align-items-center">
        <div class="col">
          <h2 class="page-title" style="margin-left: 30px ">
            Monitoring Absensi Guru
          </h2>
        </div>
      </div>
    </div>
  </div>
  <div class="page-body" style="margin-left: 15px">
    <div class="container-xxl">
        <div class="row">
            <div class="col-12">
               <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="input-icon">
                                <span class="input-icon-addon">
                                  <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-calendar-event"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 5m0 2a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2z" /><path d="M16 3l0 4" /><path d="M8 3l0 4" /><path d="M4 11l16 0" /><path d="M8 15h2v2h-2z" /></svg>
                                </span>
                                <input  type="text" id="tgl" name="tgl" value="{{ date("Y-m-d") }}" class="form-control" placeholder="Tanggal Absensi " autocomplete="off">   
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 table-wrapper">
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr style="text-align: center">
                                        <th>No</th>
                                        <th>NUPTK</th>
                                        <th>Nama Guru</th>
                                        <th>Jam Masuk</th>
                                        <th>Foto Masuk</th> 
                                        <th>Jam Pulang</th>
                                        <th>Foto Pulang</th>
                                        <th>Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody id="loadabsensi"></tbody>
                            </table>
                        </div>
                    </div>
                </div>
               </div>
            </div>
        </div>
    </div>
  </div>      
  @endsection      
  @push('myscript')
    <script>
        $(function () {
            $("#tgl").datepicker({ 
                    autoclose: true, 
                    todayHighlight: true,
                    format: 'yyyy-mm-dd'
            });

            function loadabsensi(){
              var tgl = $("#tgl").val();
                 $.ajax({
                    type:"POST",
                    url: "/getmonitoring",
                    data:{
                        _token: "{{ csrf_token() }}",
                        tgl: tgl                        
                    },
                    cache: false,
                    success: function(respond){
                        $("#loadabsensi").html(respond);
                    }
                });
            }

            $("#tgl").change(function(e){
                 loadabsensi();
            });
            
            loadabsensi();
        });
    </script>
  @endpush