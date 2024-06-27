
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>LAPORAN ABSENSI GURU </title>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/7.0.0/normalize.min.css">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/paper-css/0.4.1/paper.css">
  <style>
    @page {
     size: A4 
    }
    #title {
        font-family: Arial, Helvetica, sans-serif;
        font-size: 15px;
        font-weight: bold;
    }

    .tabelguru{
        margin-top: 35px;
    }
    .tabelguru td{
        padding: 7px;
    }
    .tabelabsen{
        width: 100%;
        margin-top: 30px;
        border-collapse: collapse; 
    }
    .tabelabsen tr th{
        border: 1px solid #131212;
        padding: 8px;
        background-color: #dbdbdb;
    }
    .tabelabsen tr td{
        border: 1px solid #131212;
        padding: 5px;
        font-size: 13px;
        text-align: center;
    }
  </style>
</head>

<!-- Set "A5", "A4" or "A3" for class name -->
<!-- Set also "landscape" if you need -->
<body class="A4">

  <!-- Each sheet element should have the class "sheet" -->
  <!-- "padding-**mm" is optional: you can set 10, 15, 20 or 25 -->
  <section class="sheet padding-10mm">
    <table style="width: 100%">
        <tr>
            <td style="width: 30px">
                <img src="{{ asset('assets/img/logo sd.jpg') }}" width="70" height="70" alt="">
            </td>
            <td>
                <span id="title">
                    LAPORAN ABSENSI GURU<br>
                    PERIODE {{ $namabulan[$bulan]}} {{ $tahun }}<br> 
                    SDN SERUA 3 <br>
                </span>
                <span>Alamat</span>
            </td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
    </table>
    <table class="tabelguru">
        <tr>
            <td rowspan="6">
                @php
                    $foto = Storage::url('uploads/guru/'.$guru->foto);
                @endphp
                <img src="{{ url($foto) }}" alt="" width="130px" height="130px">
            </td>
        </tr>
        <tr>
            <td>NUPTK</td>
            <td>:</td>
            <td>{{ $guru->nuptk }}</td>
        </tr>
        <tr>
            <td>Nama Guru</td>
            <td>:</td>
            <td>{{ $guru->nama }}</td>
        </tr>
        <tr>
            <td>Jabatan</td>
            <td>:</td>
            <td>{{ $guru->jabatan }}</td>
        </tr>
        <tr>
            <td>No Hp</td>
            <td>:</td>
            <td>{{ $guru->no_hp }}</td>
        </tr>
    </table>
    <table class="tabelabsen">
        <tr>
            <th>No</th>
            <th>Tanggal</th>
            <th>Jam Masuk</th>
            <th>Foto Masuk</th>
            <th>Jam Pulang</th>
            <th>Foto Pulang</th>
            <th>Keterangan</th>
        </tr>
        @foreach ($absensi as $a)
        @php
            $foto_in = Storage::url('uploads/absensi/'.$a->foto_masuk);
            $foto_out = Storage::url('uploads/absensi/'.$a->foto_pulang);
        @endphp
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ date("d-m-Y", strtotime($a->tgl_presensi)) }}</td>
            <td>{{ $a->jam_masuk }}</td>
            <td>
                <img src="{{ url($foto_in) }}" alt="" width="30px" height="30px">
            </td>
            <td>{{ $a->jam_pulang }}</td>
            <td> 
                <img src="{{ url($foto_out) }}" alt="" width="30px" height="30px">
            </td>
            <td>
                @if ($a->jam_masuk >= '07:00')
                    <span class="badge bg-danger">Terlambat {{ $a->jam_masuk }}</span>
                @else
                    <span class="badge bg-success">Tepat Waktu</span>
                @endif
            </td>
        </tr>
        @endforeach
    </table>
  </section>

</body>

</html>