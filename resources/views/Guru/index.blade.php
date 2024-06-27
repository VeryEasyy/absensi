@extends('layouts.admin.template')
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <title>Data Guru</title>
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
    </style>
  </head>

  @section('content')
  <div class="page-header d-print-none">
    <div class="container-xl">
      <div class="row g-2 align-items-center">
        <div class="col">
          <h2 class="page-title" style="margin-left: 30px">
            Data Guru
          </h2>
        </div>
      </div>
    </div>
  </div>
  <div class="page-body">
    <div class="container-xxl">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                      <div class="row">
                        <div class="col-12">
                            @if (Session::get('success'))
                            <div class="alert alert-success">
                              {{ Session::get('success') }}
                            </div>
                            @endif

                            @if (Session::get('error'))
                            <div class="alert alert-danger">
                              {{ Session::get('error') }}
                            </div>
                            @endif
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-12">
                          <form action="/guru" method="GET">
                            <div class="row">
                              <div class="col-6">
                                <div class="form-group">
                                  <input type="text" class="form-control" name="nama_guru" id="nama_guru" 
                                      placeholder="Search Nama Guru" value="{{ Request('nama_guru') }}">
                                </div>
                              </div>
                              <div class="col-2">
                                <div class="form-group">
                                  <button type="submit" class="btn btn-primary">
                                    <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-search"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0" /><path d="M21 21l-6 -6" /></svg>
                                    search
                                  </button>
                                </div>
                              </div>
                            </div>
                          </form>
                        </div>
                      </div>
                      <div class="row mt-2">
                        <div class="col-12">
                          <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>NUPTK</th>
                                    <th>Nama</th>
                                    <th>Profesi</th>
                                    <th>No HP</th>
                                    <th>Foto</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($guru as $g)
                                @php
                                    $path = Storage::url('uploads/guru/'.$g->foto);
                                @endphp
                                    <tr>
                                        <td>{{ $loop->iteration + $guru->firstItem()-1 }}</td>
                                        <td>{{ $g->nuptk }}</td>
                                        <td>{{ $g->nama }}</td>
                                        <td>{{ $g->jabatan }}</td>
                                        <td>{{ $g->no_hp }}</td>
                                        <td>
                                            @if (empty($g->foto))
                                            <img src="{{ asset('assets/img/nonefoto.jpg') }}" class="avatar" alt="">
                                            @else
                                            <img src="{{ url($path) }}" class="avatar" alt="">
                                            @endif
                                        </td>
                                        <td class="d-flex align-items-center">
                                          <!-- Edit Button -->
                                          <div class="me-2">
                                            <a href="#" class="btn btn-primary btn-sm d-flex align-items-center edit" nuptk='{{ $g->nuptk }}'>
                                              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-edit me-1">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" />
                                                <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" />
                                                <path d="M16 5l3 3" />
                                              </svg>
                                              Edit
                                            </a>
                                          </div>
                                          <!-- Delete Button -->
                                          <div>
                                            <form action="/guru/{{ $g->nuptk }}/delete" method="POST" style="display:inline;">
                                              @csrf
                                              <button class="btn btn-danger btn-sm hapus d-flex align-items-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-trash me-1">
                                                  <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                  <path d="M4 7l16 0" />
                                                  <path d="M10 11l0 6" />
                                                  <path d="M14 11l0 6" />
                                                  <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                                                  <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                                                </svg>
                                                Hapus
                                              </button>
                                            </form>
                                          </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        </div>
                      </div>
                        {{ $guru->links('vendor.pagination.bootstrap-5') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
  </div>
  <div class="modal modal-blur fade" id="modal-edit" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Edit Data Guru</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" id="loadedit">
          
        </div>
        {{-- <div class="modal-footer">
          <button type="button" class="btn me-auto btn-danger" data-bs-dismiss="modal">
            Batal
          </button>
          <button type="button" class="btn btn-primary" data-bs-dismiss="modal">
            Edit
          </button>
        </div> --}}
      </div>
    </div>
  </div>
  @endsection

  @push('myscript')
      <script>
        $(function(){
          $(".edit").click(function(){
              var nuptk = $(this).attr('nuptk');

              $.ajax({
                  type: 'POST',
                  url: '/guru/edit',
                  cache: false,
                  data:{
                    _token: "{{ csrf_token() }}",
                    nuptk: nuptk
                  },
                  success: function(respond){
                    $("#loadedit").html(respond);
                  }
              });
              $("#modal-edit").modal("show");
          });

          $(".hapus").click(function(e) {
            var form = $(this).closest('form');
            e.preventDefault();
            Swal.fire({
              title: "Apakah Anda Yakin Ingin Menghapus Data Ini?",
              showCancelButton: true,
              confirmButtonText: "Delete",
            }).then((result) => {
              /* Read more about isConfirmed, isDenied below */
              if (result.isConfirmed) {
                form.submit();
                Swal.fire("Data Berhasil Di Hapus!", "", "success");
              }
            });
          });
        });
      </script>
  @endpush