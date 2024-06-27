<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>LAPORAN SELURUH ABSENSI GURU</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/7.0.0/normalize.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/paper-css/0.4.1/paper.css">
    <style>
        @page {
            size: A4 landscape;
        }
        #title {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 15px;
            font-weight: bold;
        }
        .logo-container {
            display: flex;
            align-items: center;
        }
        .logo-container img {
            margin-right: 10px; /* Jarak antara logo dengan teks */
        }
        .title-container {
            margin-left: 20px; /* Jarak antara logo dengan judul */
        }
        .address {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 12px;
            margin-top: 5px; /* Jarak antara judul dengan alamat */
        }
        .tabelguru {
            margin-top: 35px;
        }
        .tabelguru td {
            padding: 3px;
        }
        .tabelabsen {
            width: 100%;
            margin-top: 30px;
            border-collapse: collapse; 
        }
        .tabelabsen tr th {
            border: 1px solid #131212;
            padding: 5px;
            background-color: #dbdbdb;
            font-size: 10px;
        }
        .tabelabsen tr td {
            border: 1px solid #131212;
            padding: 5px;
            font-size: 10px;
            text-align: center;
        }
    </style>
</head>
<body class="A4 landscape">
    <section class="sheet padding-10mm">
        <table style="width: 100%">
            <tr>
                <td style="width: 20px">
                    <div class="logo-container">
                        <img src="{{ asset('assets/img/logo sd.jpg') }}" width="60" height="60" alt="">
                    </div>
                </td>
                <td class="title-container">
                    <span id="title">
                        LAPORAN SELURUH ABSENSI GURU<br>
                        PERIODE {{ $namabulan[$bulan]}} {{ $tahun }}<br> 
                        SDN SERUA 3
                    </span>
                    <br>
                    <span class="address">Alamat</span>
                </td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
        </table>
        <table class="tabelabsen">
            <tr>
                <th rowspan="2">NUPTK</th>
                <th rowspan="2">Nama Guru</th>
                <th colspan="31">Tanggal</th>
                <th rowspan="2">THadir</th>
                <th rowspan="2">TTelat</th>
            </tr>
            <tr>
                <?php
                    for ($i=1; $i<=31; $i++) { 
                    ?>    
                     <th>{{ $i }}</th>
                    <?php    
                    }
                    ?>  
            </tr>
            @foreach ($rekap as $r)
            <tr>
                <td>{{ $r->nuptk_absen }}</td>
                <td>{{ $r->nama }}</td>
                <?php
                $totalhadir = 0;
                $totaltelat = 0;
                for ($i=1; $i<=31; $i++) { 
                    $tgl = "tgl_".$i;
                    $totalhadir += 0;
                    $totaltelat +=0;
                    if(empty($r->$tgl)){
                        $absen = ['',''];
                    }else{
                        $absen = explode("-",$r->$tgl);
                        $totalhadir += 1;
                        if($absen[0] > "07:00:00"){
                            $totaltelat +=1;
                        }
                    }
                ?>
                <td><span style="color:{{ $absen[0] > "07:00:00" ? "red" : "" }}">{{ $absen[0] }} - </span><br>
                    <span style="color:{{ $absen[1] < "15:00:00" ? "red" : "" }}">{{ $absen[1] }}</span>
                </td>
                <?php
                }
                ?>
                <td>{{ $totalhadir }}</td>
                <td>{{ $totaltelat }}</td>
            </tr>
            @endforeach
        </table>
    </section>
</body>
</html>
