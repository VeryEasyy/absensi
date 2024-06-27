@if ($histori->isEmpty())
    <div class="alert alert-outline-warning">
        <b>Tanggal Hadir Belum Ada</b>
    </div>
@endif

@foreach ($histori as $d)
    <ul class="listview image-listview">
        <li>
            <div class="item">
                @php
                    $path = Storage::url('uploads/absensi/' . $d->foto_masuk);
                @endphp
                <img src="{{ $path }}" alt="image" class="image">
                <div class="in">
                    <div>
                        <b>{{ date("d-m-Y",strtotime($d->tgl_presensi)) }}</b><br>
                    
                    </div>
                    <span class="badge {{ $d->jam_masuk < "07:00" ? "bg-success" : "bg-danger" }}">
                        {{ $d->jam_masuk }}
                    </span>
                    <span class="badge {{ $d->jam_pulang > "12:00" ? "bg-success" : "bg-danger" }}">
                        {{ $d->jam_pulang }}
                    </span>
                </div>
            </div>
        </li>
    </ul>
@endforeach