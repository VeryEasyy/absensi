<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;



class DashboardController extends Controller
{
    public function homeUser(){
        $tglsekarang = date("Y-m-d");
        $bulanini = date('m');
        $tahunini = date('Y');
        $nuptk = Auth::guard('karyawan')->user()->nuptk;
        
        $absensekarang = DB::table('presensis')
        ->where('nuptk_absen', $nuptk)
        ->where('tgl_presensi', $tglsekarang)
        ->first();

        $rekapizin = DB::table('izins')
        ->selectRaw('COUNT(status) as jmldata')
        ->where('nuptk', $nuptk)
        ->whereRaw('MONTH(tgl_izin)="' . $bulanini . '"')
        ->whereRaw('YEAR(tgl_izin)="' . $tahunini . '"')
        ->where('status_approved', null)
        ->first();

        $rekapdinas = DB::table('dinas')
        ->selectRaw('COUNT(nuptk) as jmldinas')
        ->where('nuptk', $nuptk)
        ->whereRaw('MONTH(tgl_mulai)="' . $bulanini . '"')
        ->whereRaw('YEAR(tgl_mulai)="' . $tahunini . '"')
        ->where('status_approved', null)
        ->first();


        return view('dashboard.dashboard', compact('absensekarang', 'rekapizin', 'rekapdinas'));
    }

    public function homeAdmin(){
        $hariini = date("Y-m-d");
    

        $rekapguru = DB::table('karyawan')
        ->selectRaw('COUNT(nuptk) as jmlguru')
        ->first();

        $rekapabsensi = DB::table('presensi')
        ->selectRaw('COUNT(nuptk_absen) as jmlhadir, SUM(IF(jam_masuk > "07:00",1,0)) as jmlterlambat')
        ->where('tgl_presensi', $hariini)
        ->first();

        $rekapizin = DB::table('izin')
        ->selectRaw('SUM(IF(status="i",1,0)) as jmlizin, SUM(IF(status="s",1,0)) as jmlsakit')
        ->where('tgl_izin', $hariini)
        ->where('status_approved', NULL)
        ->first();

        
        $rekapdinas = DB::table('dinas')
        ->selectRaw('COUNT(nuptk) as jmldinas')
        // ->where('tgl_mulai', $hariini)
        ->where('status_approved', NULL)
        ->first();


        return view('dashboard.dashboardadmin', compact('rekapabsensi', 'rekapguru', 'rekapizin', 'rekapdinas'));
    }

}
