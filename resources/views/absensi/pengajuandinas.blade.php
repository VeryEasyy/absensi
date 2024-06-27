@extends('layouts.admin.template')

<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <title>Data Pengajuan Izin Dinas</title>
    <style>
        .table tr td{
            font-size: 13px;
            text-align: center;
            
        }
    </style>
</head>


  @section('content')
  <div class="page-header d-print-none">
    <div class="container-xxl">
      <div class="row g-2 align-items-center">
        <div class="col">
          <h2 class="page-title" style="margin-left: 30px ">
            Data Pengajuan Izin Dinas
          </h2>
        </div>
      </div>
    </div>
  </div>
  <div class="page-body" style="margin-left: 15px">
    <div class="container-xxl">
        <div class="row">
            <div class="col-12">
                <h4>Data Izin Dinas</h4>
                <form action="/absensi/pengajuandinas" method="GET" autocomplete="off">
                    <div class="row">
                        <div class="col-6">
                            <div class="input-icon mb-2">
                                <span class="input-icon-addon">
                                  <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-calendar-event"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 5m0 2a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2z" /><path d="M16 3l0 4" /><path d="M8 3l0 4" /><path d="M4 11l16 0" /><path d="M8 15h2v2h-2z" /></svg>
                                </span>
                                <input  type="text" id="mulai" name="mulai" value="" class="form-control" placeholder="Tanggal Mulai Dinas " autocomplete="off">   
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="input-icon mb-2">
                                <span class="input-icon-addon">
                                  <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-calendar-event"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 5m0 2a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2z" /><path d="M16 3l0 4" /><path d="M8 3l0 4" /><path d="M4 11l16 0" /><path d="M8 15h2v2h-2z" /></svg>
                                </span>
                                <input  type="text" id="selesai" name="selesai" value="" class="form-control" placeholder="Tanggal Selesai Dinas " autocomplete="off">   
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-3">
                            <div class="d-flex align-items-center">
                                <div class="input-icon flex-grow-1">
                                    <span class="input-icon-addon">
                                        <!-- Download SVG icon from http://tabler-icons.io/i/user -->
                                        <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-id-badge-2"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M7 12h3v4h-3z" /><path d="M10 6h-6a1 1 0 0 0 -1 1v12a1 1 0 0 0 1 1h16a1 1 0 0 0 1 -1v-12a1 1 0 0 0 -1 -1h-6" /><path d="M10 3m0 1a1 1 0 0 1 1 -1h2a1 1 0 0 1 1 1v3a1 1 0 0 1 -1 1h-2a1 1 0 0 1 -1 -1z" /><path d="M14 16h2" /><path d="M14 12h4" /></svg>
                                    </span>
                                    <input type="text" value="" name="nuptk" class="form-control" placeholder="NUPTK">
                                </div>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="d-flex align-items-center">
                                <div class="input-icon flex-grow-1">
                                    <span class="input-icon-addon">
                                        <!-- Download SVG icon from http://tabler-icons.io/i/user -->
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0"></path>
                                            <path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path>
                                        </svg>
                                    </span>
                                    <input type="text" value="{{ Request('username') }}" name="username" class="form-control" placeholder="Username">
                                </div>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <select name="status_approved" id="status_approved" class="form-select">
                                    <option value="">Pilih Status</option>
                                    <option value="0" {{ Request('status_approved') === '0' ? 'selected' : "" }}>Pending</option>
                                    <option value="1" {{ Request('status_approved') == 1 ? 'selected' : "" }}>Disetujui</option>
                                    <option value="2" {{ Request('status_approved') == 2 ? 'selected' : "" }}>Ditolak</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group" style="margin-left: 7px;">
                                <button type="submit" class="btn btn-primary d-flex align-items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-search">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                        <path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0" />
                                        <path d="M21 21l-6 -6" />
                                    </svg>
                                    Cari
                                </button>
                            </div>
                        </div>
                    </div>
                    
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <table class="table table-bordered ">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>NUPTK</th>
                            <th>Nama Guru</th>
                            <th>Tipe Dinas</th>
                            <th>Alamat Dinas</th>
                            <th>Waktu</th>
                            <th>Keterangan</th>
                            <th>Status Approved</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pengajuandinas as $d)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ date('d/m/Y',strtotime($d->tgl_mulai)) }} - {{ date('d/m/Y',strtotime($d->tgl_selesai)) }}</td>
                            <td>{{ $d->nuptk }}</td>
                            <td>{{ $d->nama }}</td>
                            <td>{{ $d->tipe_dinas }}</td>
                            <td>{{ $d->alamat_dinas }}</td>
                            <td >{{ date('H:i:s', strtotime($d->waktu_mulai)) }} - {{ date('H:i:s', strtotime($d->waktu_selesai)) }}</td>
                            <td>{{ $d->keterangan }}</td>
                            <td>
                                @if ($d->status_approved == 1)
                                    <span class="badge bg-success" style="color: black;">Disetujui</span>
                                @elseif ($d->status_approved == 2)
                                    <span class="badge bg-danger" style="color: black;">Ditolak</span>
                                @elseif(is_null($d->status_approved) || $d->status_approved == 0)
                                    <span class="badge bg-warning" style="color: black;">Pending</span>
                                @endif
                            </td>
                            <td>
                                @if ($d->status_approved == 0 )
                                    <a href="#" class="btn btn-sm btn-primary" id="dinas" id_izindinas="{{ $d->id }}">
                                        <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-external-link"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 6h-6a2 2 0 0 0 -2 2v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-6" /><path d="M11 13l9 -9" /><path d="M15 4h5v5" /></svg>
                                        Konfirmasi
                                    </a>
                                @else
                                <a href="/absensi/{{ $d->id }}/batalizindinas" class="btn btn-sm btn-danger d-flex align-items-center justify-content-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-circle-x" style="margin-right: 8px;">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                        <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0"/>
                                        <path d="M10 10l4 4m0 -4l-4 4"/>
                                    </svg>
                                    Batal
                                </a>
                                @endif
                            </td>
                        </tr>  
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        {{ $pengajuandinas->links('vendor.pagination.bootstrap-5') }}
    </div>
  </div>
  <div class="modal modal-blur fade" id="modal-izindinas" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Izin Dinas</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/absensi/approveizindinas" method="POST">
                    @csrf
                    <input type="hidden" name="id_izindinas_form" id="id_izindinas_form">
                    <div class="row">
                        <div class="col-12 mt-2">
                            <div class="form-group">
                                <select name="status_approved" id="status_approved" class="form-select">
                                    <option value="1">Disetujui</option>
                                    <option value="2">Ditolak</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-12">
                            <div class="form-group">
                                <button class="btn btn-primary w-100" type="submit">
                                    <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-send-2"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4.698 4.034l16.302 7.966l-16.302 7.966a.503 .503 0 0 1 -.546 -.124a.555 .555 0 0 1 -.12 -.568l2.468 -7.274l-2.468 -7.274a.555 .555 0 0 1 .12 -.568a.503 .503 0 0 1 .546 -.124z" /><path d="M6.5 12h14.5" /></svg>
                                    Kirim
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
  </div>
  @endsection

  @push('myscript')
  <script>
      $(function(){
          $("#approve").click(function(e){
              e.preventDefault();
              var id_izinsakit = $(this).attr("id_izinsakit");
              $("#id_izinsakit_form").val(id_izinsakit);
              $("#modal-izinsakit").modal("show");
          });

          $("#dinas").click(function(e){
              e.preventDefault();
              var id_izindinas = $(this).attr("id_izindinas");
              $("#id_izindinas_form").val(id_izindinas);
              $("#modal-izindinas").modal("show");
          });

          $("#mulai").datepicker({ 
                  autoclose: true, 
                  todayHighlight: true,
                  format: 'yyyy-mm-dd'
          });

          $("#selesai").datepicker({ 
                  autoclose: true, 
                  todayHighlight: true,
                  format: 'yyyy-mm-dd'
          });
      });
  </script>
@endpush
