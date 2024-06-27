@extends('layouts.absensi')

@section('content')
<div class="section" id="user-section">
    {{-- <div class="user-detail">
        <div class="avatar" style="text-align: right">
            <img src="assets/img/logo sd.jpg" alt="avatar" style="height: 10px">
        </div>
    </div> --}}
    <div id="user-detail">
    
        <div class="avatar"  style="margin-top: 1rem">
            @if (!empty(Auth::guard('karyawan')->user()->foto))
                @php
                    $path = Storage::url('uploads/guru/'.Auth::guard('karyawan')->user()->foto);
                @endphp
                 <img src="{{ url($path) }}" alt="avatar" class="imaged w64 rounded" style="height: 60px">
            @else
                <img src="assets/img/sample/avatar/avatar1.jpg" alt="avatar" class="imaged w64 rounded">
            @endif
        </div>
        <div id="user-info">
            <h2 id="user-name">{{ Auth::guard('karyawan')->user()->nama }}</h2>
            <span id="user-role">{{ Auth::guard('karyawan')->user()->jabatan }}</span>
        </div>
    </div>
</div>

<div class="section" id="menu-section">
    <div class="card">
        <div class="card-body text-center">
            <div class="list-menu">
                <div class="item-menu text-center">
                    <div class="menu-icon">
                        <a href="/profile" class="blue" style="font-size: 40px;">
                            <ion-icon name="person-sharp"></ion-icon>
                        </a>
                    </div>
                    <div class="menu-name">
                        <span class="text-center">Profil</span>
                    </div>
                </div>
                <div class="item-menu text-center">
                    <div class="menu-icon" style="position: relative; display: inline-block;">
                        <a href="/absensi/dataizin" class="warning" style="font-size: 40px;">
                            <ion-icon name="document-text" style="font-size: 40px; display: inline-block; position: relative;"></ion-icon>
                            @php
                                $totalBadge = $rekapizin->jmldata + $rekapdinas->jmldinas;
                            @endphp
                            @if ($totalBadge != 0)
                            <b><span class="bagde" style="position: absolute; top: 25%; left: 32%; transform: translate(-50%, -50%); 
                                font-size: 12px; color: red;">{{ $totalBadge }}</span></b>
                            
                            @endif
                        </a>
                    </div>
                    <div class="menu-name">
                        <span class="text-center">Data Pengajuan</span>
                    </div>
                </div>
                <div class="item-menu text-center">
                    <div class="menu-icon">
                        <a href="/absensi/histori" class="green" style="font-size: 40px;">
                            <ion-icon name="folder"></ion-icon>
                        </a>
                    </div>
                    <div class="menu-name">
                        <span class="text-center">Histori Absensi</span>
                    </div>
                </div>
                <div class="item-menu text-center">
                    <div class="menu-icon">
                        <a href="/absensi/lokasi" class="orange" style="font-size: 40px;">
                            <ion-icon name="location"></ion-icon>
                        </a>
                    </div>
                    <div class="menu-name">
                        Lokasi
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="section mt-2" id="presence-section">
    <div class="todaypresence">
        <div class="row">
            <div class="col-6">
                <div class="card gradasigreen">
                    <div class="card-body">
                        <div class="presencecontent">
                            <div class="iconpresence">
                                @if ($absensekarang != null)
                                    @php
                                        $path = Storage::url('/uploads/absensi/' . $absensekarang->foto_masuk);
                                    @endphp
                                        <img src="{{ url($path) }}" alt="" class="imaged w64 ">
                                    @else
                                        <ion-icon name="camera"></ion-icon>
                                 @endif
                            </div>
                            <div class="presencedetail">
                                <h4 class="presencetitle">Masuk</h4>
                                <span>{{ $absensekarang != null ? $absensekarang->jam_masuk : 'Belum Absen' }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="card gradasired">
                    <div class="card-body">
                        <div class="presencecontent">
                            <div class="iconpresence">
                                @if ($absensekarang != null && $absensekarang->jam_pulang != null)
                                    @php
                                        $path = Storage::url('/uploads/absensi/' . $absensekarang->foto_pulang);
                                    @endphp
                                        <img src="{{ url($path) }}" alt="" class="imaged w64 ">
                                    @else
                                        <ion-icon name="camera"></ion-icon>
                                 @endif
                            </div>
                            <div class="presencedetail">
                                <h4 class="presencetitle">Pulang</h4>
                                <span>{{ $absensekarang != null && $absensekarang->jam_pulang != null ? $absensekarang->jam_pulang : 'Belum Absen' }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

    
@endsection