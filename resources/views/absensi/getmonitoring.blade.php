@php
      function selisih($jam_masuk, $jam_keluar)
        {
            list($h, $m, $s) = explode(":", $jam_masuk);
            $dtAwal = mktime($h, $m, $s, "1", "1", "1");
            list($h, $m, $s) = explode(":", $jam_keluar);
            $dtAkhir = mktime($h, $m, $s, "1", "1", "1");
            $dtSelisih = $dtAkhir - $dtAwal;
            $totalmenit = $dtSelisih / 60;
            $jam = explode(".", $totalmenit / 60);
            $sisamenit = ($totalmenit / 60) - $jam[0];
            $sisamenit2 = $sisamenit * 60;
            $jml_jam = $jam[0];
            return $jml_jam . ":" . round($sisamenit2);
        }

@endphp

@foreach ($absensi as $a)
@php
    
    $foto_in = Storage::url('uploads/absensi/'.$a->foto_masuk);
    $foto_out = Storage::url('uploads/absensi/'.$a->foto_pulang);
@endphp
    <tr style="text-align: center;  ">
        <td>{{ $loop->iteration }}</td>
        <td>{{ $a->nuptk_absen }}</td>
        <td>{{ $a->nama }}</td>
        <td>{{ $a->jam_masuk }}</td>
        <td >
            <img src="{{ url($foto_in) }}" class="avatar" alt="">
        </td>
        <td>{!! $a->jam_pulang != null ? $a->jam_pulang : '<span class="badge bg-danger">Belum Absen</span>' !!}</td>
        <td>
            @if ($a->jam_pulang != null)
            <img src="{{ url($foto_out) }}" class="avatar" alt="">
            @else
            <svg 
                 xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-hourglass">
                 <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                 <path d="M6.5 7h11" />
                 <path d="M6.5 17h11" />
                 <path d="M6 20v-2a6 6 0 1 1 12 0v2a1 1 0 0 1 -1 1h-10a1 1 0 0 1 -1 -1z" />
                 <path d="M6 4v2a6 6 0 1 0 12 0v-2a1 1 0 0 0 -1 -1h-10a1 1 0 0 0 -1 1z" />
            </svg>
            @endif
            
        </td>
        <td >
            @if ($a->jam_masuk >= '07:00')
                @php
                   $jamterlambat = selisih('07:00:00', $a->jam_masuk);
                @endphp
                <span class="badge bg-danger" style="color: black">Terlambat {{ $jamterlambat }}</span>
            @else
            <span class="badge bg-success" style="color: black">Tepat Waktu</span>
            @endif
        </td>
    </tr>
@endforeach