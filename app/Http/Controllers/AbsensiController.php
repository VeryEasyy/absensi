<?php

namespace App\Http\Controllers;

use App\Models\pengajuandinas;
use App\Models\pengajuanizin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
class AbsensiController extends Controller
{
    public function masuk(){
        $hariini = date("Y-m-d");
        $nuptk = Auth::guard('karyawan')->user()->nuptk;
        $cek = DB::table('presensi')->where('tgl_presensi', $hariini)->where('nuptk_absen',$nuptk)->count();
        return view("absensi.masuk", compact('cek'));
    }

    public function store(Request $request){
        $nuptk = Auth::guard('karyawan')->user()->nuptk;
        $tgl_absen = date("Y-m-d");
        $jam = date("H:i:s");
        $lokasi = $request->lokasi;
        $lokasiuser = explode(",", $lokasi);
        $latkantor = floatval($lokasiuser[0]);
        $longkantor = floatval($lokasiuser[1]);
        $latuser = floatval($lokasiuser[0]);
        $longuser = floatval($lokasiuser[1]);

        $jarak = $this->HitungJarak($latkantor, $longkantor, $latuser, $longuser);
        // $radius = round($jarak("meters"));
        $image = $request->image;
        $folderPath = "public/uploads/absensi/";
        $formatName = $nuptk."-".$tgl_absen;
        $image_parts = explode(";base64",$image);
        $image_base64 = base64_decode($image_parts[1]);
        $fileName1 = $formatName . "-". "masuk" . ".png";
        $fileName2 = $formatName . "-". "pulang" . ".png";
        $file1 = $folderPath . $fileName1;
        $file2 = $folderPath . $fileName2;
        $nama_hari = array(1=>'Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu');
        $hari = date("N");
        $hari_masuk = $nama_hari[$hari];
       
        $cek = DB::table('presensi')->where('tgl_presensi', $tgl_absen)->where('nuptk_absen',$nuptk)->count();
        if($jarak > 50){
            echo "error|Maaf Anda Berada Diluar Jangkauan Lokasi Absen, Jarak Anda " . round($jarak) . " Meter dari Lokasi Absen";
        }else {
        if($cek > 0){
            $data_pulang = [
                'jam_pulang' => $jam,
                'foto_pulang' => $fileName2,
                'lokasi_pulang' => $lokasi

            ];
        $update = DB::table('presensi')->where('tgl_presensi', $tgl_absen)->where('nuptk_absen',$nuptk)->update($data_pulang);
        if($update){
            echo "success|Absen Pulang Telah Berhasil|out";
            Storage::put($file2,$image_base64);
        }else{
            echo "error|Maaf Absen Gagal Harap Coba Lagi|out";
        }

        }else{
            $data_masuk = [
                'nuptk_absen' => $nuptk,
                'tgl_presensi' => $tgl_absen,
                'jam_masuk' => $jam,
                'hari' => $hari_masuk,
                'foto_masuk' => $fileName1,
                'lokasi_masuk' => $lokasi
            ];
            $simpan = DB::table('presensi')->insert($data_masuk);
            if($simpan){
                echo "success|Absen Masuk Telah Berhasil|in";
                Storage::put($file1,$image_base64);
            }else{
                echo "error|Maaf Absen Gagal Harap Coba Lagi|in";
            }
        } 
     }
    }
 //Menghitung Jarak
    public function hitungJarak($lat1, $lon1, $lat2, $lon2)
    {
        $theta = $lon1 - $lon2;
        $miles = (sin(deg2rad($lat1)) * sin(deg2rad($lat2))) +
            (cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta)));
        $miles = acos($miles);
        $miles = rad2deg($miles);
        $miles = $miles * 60 * 1.1515;
        $kilometers = $miles * 1.609344;
        $meters = $kilometers * 1000;
        return $meters;
    }

    public function profile()
    {
        return view('absensi.profile');
    }

    public function editprofile()
    {
        $nuptk = Auth::guard('karyawan')->user()->nuptk;
        $guru = DB::table('karyawan')->where('nuptk', $nuptk)->first();

        return view('absensi.editprofile', compact('guru'));
    }

    public function updateprofile(Request $request){
        $nuptk = Auth::guard('karyawan')->user()->nuptk;
        $nama = $request->nama;
        $profesi = $request->profesi;
        $no_hp = $request->no_hp;
        $guru = DB::table('karyawan')->where('nuptk', $nuptk)->first();
        if($request->hasFile('foto')){
            $foto = $nuptk . "." . $request->file('foto')->getClientOriginalExtension(); 
        }else {
            $foto = $guru->foto;
        }
        $data = [
            'nama' => $nama,
            'jabatan' => $profesi,
            'no_hp' => $no_hp,
            'foto' => $foto
        ];

        $update = DB::table('karyawan')->where('nuptk',$nuptk)->update($data);
        if($update){
            if($request->hasFile('foto')){
               $folderpath = "public/uploads/guru/";
               $request->file('foto')->storeAs($folderpath, $foto);
            }
            return Redirect::back()->with(['success'=>'Data Berhasil Di Update']);
        }else{
            return Redirect::back()->with(['error'=>'Data Gagal Di Update']);;
        }
    }

    
    public function editpassword()
    {
        $nuptk = Auth::guard('karyawan')->user()->nuptk;
        $guru = DB::table('karyawan')->where('nuptk', $nuptk)->first();

        return view('absensi.editpassword', compact('guru'));
    }

    public function updatepass(Request $request){
        $nuptk = Auth::guard('karyawan')->user()->nuptk;
        $pass1 = $request->password1;
        $pass2 = $request->password2;

        if($pass1 !== $pass2){
            return Redirect::back()->with(['info' => 'Konfirmasi Password Tidak Sesuai']);
        }
            $pass1 = Hash::make($request->password1);
            $data = [
                    'password' => $pass1,
                ];
             
        

       
        
            

        $update = DB::table('karyawan')->where('nuptk',$nuptk)->update($data);
        if($update){
            return Redirect::back()->with(['success'=>'Password Berhasil Di Ganti']);
        }else{
            return Redirect::back()->with(['error'=>'Password Gagal Diganti']);;
        }
    }

    public function histori() 
    {
        $namabulan = ["","Januari","Febuari","Maret","April","Mei","Juni",
                "Juli","Agustus","September","Oktober","November","Desember"];
        return view('absensi.histori', compact('namabulan'));
    }

    public function gethistori(Request $request)
    {
        $bulan = $request->bulan;
        $tahun = $request->tahun;
        $nuptk = Auth::guard('karyawan')->user()->nuptk;

        $histori = DB::table('presensi')
        ->whereRaw('MONTH(tgl_presensi)="' . $bulan . '"')
        ->whereRaw('YEAR(tgl_presensi)="' . $tahun . '"')
        ->where('nuptk_absen', $nuptk)->orderBy('tgl_presensi')
        ->get();

       
        return view('absensi.gethistori', compact('histori'));
    }

    public function izin(){
        return view('absensi.izin');
    }

    public function formizin(){

        return view('absensi.formizin');
    }

    public function storeizin(Request $request){
        $nuptk = Auth::guard('karyawan')->user()->nuptk;
        $tgl_izin = \DateTime::createFromFormat('m/d/Y', $request->tgl_izin)->format('Y-m-d');
        $status = $request->status;
        $ket = $request->ket;
        
        $cek = DB::table('izin')->where('tgl_izin', $tgl_izin)->where('nuptk',$nuptk)->count();
        
        if($cek > 0){
            return redirect('/absensi/formizin')->with(['warning' => 'Anda Sudah Mengirim Data Izin']);
        }else{
            $data = [
                'nuptk' => $nuptk,
                'tgl_izin' => $tgl_izin,
                'status' => $status,
                'keterangan' => $ket
            ];
            
            $simpan = DB::table('izin')->insert($data);
    
            if($simpan){
                return redirect('/absensi/formizin')->with(['success' => 'Data Berhasil Dikirim']);
            }else{
                return redirect('/absensi/formizin')->with(['error' => 'Data Gagal Dikirim']);
            }
        } 
        

    } 
    
    public function dataizin(){
        $nuptk = Auth::guard('karyawan')->user()->nuptk;
        $dataizin = DB::table('izin')
        ->where('nuptk', $nuptk)
        ->where('status_approved', null)
        ->get();

        $datadinas = DB::table('dinas')
        ->where('nuptk', $nuptk)
        ->where('status_approved', null)
        ->get();

        $combinedData = $dataizin->merge($datadinas);

        return view('absensi.dataizin', compact('combinedData'));
    } 

    public function historyizin(){
        $namabulan = ["","Januari","Febuari","Maret","April","Mei","Juni",
        "Juli","Agustus","September","Oktober","November","Desember"];
        return view('absensi.historyizin', compact('namabulan'));
    }

    public function gethistoryizin(Request $request)
    {
        $bulan = $request->bulan;
        $tahun = $request->tahun;
        $nuptk = Auth::guard('karyawan')->user()->nuptk;

        $historiizin = DB::table('izin')
        ->whereRaw('MONTH(tgl_izin)="' . $bulan . '"')
        ->whereRaw('YEAR(tgl_izin)="' . $tahun . '"')
        ->where('nuptk', $nuptk)->orderBy('tgl_izin')
        ->get();

        $historidinas = DB::table('dinas')
        ->whereRaw('MONTH(tgl_mulai)="' . $bulan . '"')
        ->whereRaw('YEAR(tgl_mulai)="' . $tahun . '"')
        ->where('nuptk', $nuptk)->orderBy('tgl_mulai')
        ->get();

        $combinedData = $historiizin->merge($historidinas);
        
        return view('absensi.gethistoryizin', compact('combinedData'));
    }

    public function formdinas(){

        return view('absensi.formdinas');
    }

    public function storedinas(Request $request){

        $nuptk = Auth::guard('karyawan')->user()->nuptk;
        $tipe = $request->tipe;
        $lokasi = $request->lokasi;
        $tgl_mulai = \DateTime::createFromFormat('m/d/Y', $request->checkin)->format('Y-m-d');;
        $tgl_selesai = \DateTime::createFromFormat('m/d/Y', $request->checkout)->format('Y-m-d');;
        $waktu_mulai = \DateTime::createFromFormat('H:i', $request->timein)->format('H:i:s');
        $waktu_selesai = \DateTime::createFromFormat('H:i', $request->timeout)->format('H:i:s');
        $ket = $request->ket;
        
        $cek = DB::table('dinas')->where('tgl_mulai', $tgl_mulai)->where('tgl_selesai', $tgl_selesai)->where('nuptk',$nuptk)->count();
        
        if($cek > 0){
            return redirect('/absensi/formdinas')->with(['warning' => 'Anda Sudah Mengirim Data Dinas Luar']);
        }else{
            $data = [
                'nuptk' => $nuptk,
                'tipe_dinas' => $tipe,
                'alamat_dinas' => $lokasi,
                'tgl_mulai' => $tgl_mulai,
                'tgl_selesai' => $tgl_selesai,
                'waktu_mulai' => $waktu_mulai,
                'waktu_selesai' => $waktu_selesai,
                'keterangan' => $ket
            ];
            
            $simpan = DB::table('dinas')->insert($data);
    
            if($simpan){
                return redirect('/absensi/formdinas')->with(['success' => 'Data Berhasil Dikirim']);
            }else{
                return redirect('/absensi/formdinas')->with(['error' => 'Data Gagal Dikirim']);
            }
        } 
    
    }

    public function lokasi()
    {
        return view('absensi.lokasi');
    } 


    public function monitoring(){
        return view('absensi.monitoring');
    }

    public function getmonitoring(Request $request){
        $tgl = $request->tgl;
        $absensi = DB::table('presensi')
        ->select('presensi.*','nama')
        ->join('karyawan','presensi.nuptk_absen','=','karyawan.nuptk')
        ->where('tgl_presensi', $tgl)
        ->get();

        return view('absensi.getmonitoring', compact('absensi'));
    }

    public function absensiguru(){
        $namabulan = ["","Januari","Febuari","Maret","April","Mei","Juni",
        "Juli","Agustus","September","Oktober","November","Desember"];

        $guru = DB::table('karyawan')
        ->orderBy('nama')
        ->get();

        return view('absensi/absensiguru', compact('namabulan', 'guru'));
    }

    public function getabsensi(Request $request){
        $nuptk = $request->nuptk;
        $bulan = $request->bulan;
        $tahun = $request->tahun;
        $namabulan = ["","JANUARI","FEBUARI","MARET","APRIL","MEI","JUNI",
        "JULI","AGUSTUS","SEPTEMBER","OKTOBER","NOVEMBER","DESEMBER"];
        $guru = DB::table('karyawan')
        ->where('nuptk', $nuptk)
        ->first();

        $absensi = DB::table('presensi')
        ->where('nuptk_absen', $nuptk)
        ->whereRaw('MONTH(tgl_presensi)="' . $bulan . '"')
        ->whereRaw('YEAR(tgl_presensi)="' . $tahun . '"')
        ->get();

        if(isset($_POST['exportexcel'])){
            $time = date("d-m-Y H:i:s");

            //fungsi header dengan mengirimkan raw data excel 
            header("Content-tupe: aplication/vnd-ms-excel");

            //definisi nama file export excel
            header("Content-Disposition: attachment; filename=Laporan Absensi Guru $time.xls");
        }

        return view('absensi.getabsensi', compact('bulan', 'tahun', 'namabulan', 'guru', 'absensi'));
    }

    public function rekapguru(){
        $namabulan = ["","Januari","Febuari","Maret","April","Mei","Juni",
        "Juli","Agustus","September","Oktober","November","Desember"];


        return view('absensi.rekapguru', compact('namabulan'));
    }

    public function getrekap(Request $request){
        $bulan = $request->bulan;
        $tahun = $request->tahun;
        $namabulan = ["","JANUARI","FEBUARI","MARET","APRIL","MEI","JUNI",
        "JULI","AGUSTUS","SEPTEMBER","OKTOBER","NOVEMBER","DESEMBER"];

        $rekap = DB::table('presensi')
        ->selectRaw('presensi.nuptk_absen, karyawan.nama,
            MAX(IF(DAY(tgl_presensi) = 1, CONCAT(jam_masuk, "-", IFNULL(jam_pulang, "00:00:00")), "")) as tgl_1,
            MAX(IF(DAY(tgl_presensi) = 2, CONCAT(jam_masuk, "-", IFNULL(jam_pulang, "00:00:00")), "")) as tgl_2,
            MAX(IF(DAY(tgl_presensi) = 3, CONCAT(jam_masuk, "-", IFNULL(jam_pulang, "00:00:00")), "")) as tgl_3,
            MAX(IF(DAY(tgl_presensi) = 4, CONCAT(jam_masuk, "-", IFNULL(jam_pulang, "00:00:00")), "")) as tgl_4,
            MAX(IF(DAY(tgl_presensi) = 5, CONCAT(jam_masuk, "-", IFNULL(jam_pulang, "00:00:00")), "")) as tgl_5,
            MAX(IF(DAY(tgl_presensi) = 6, CONCAT(jam_masuk, "-", IFNULL(jam_pulang, "00:00:00")), "")) as tgl_6,
            MAX(IF(DAY(tgl_presensi) = 7, CONCAT(jam_masuk, "-", IFNULL(jam_pulang, "00:00:00")), "")) as tgl_7,
            MAX(IF(DAY(tgl_presensi) = 8, CONCAT(jam_masuk, "-", IFNULL(jam_pulang, "00:00:00")), "")) as tgl_8,
            MAX(IF(DAY(tgl_presensi) = 9, CONCAT(jam_masuk, "-", IFNULL(jam_pulang, "00:00:00")), "")) as tgl_9,
            MAX(IF(DAY(tgl_presensi) = 10, CONCAT(jam_masuk, "-", IFNULL(jam_pulang, "00:00:00")), "")) as tgl_10,
            MAX(IF(DAY(tgl_presensi) = 11, CONCAT(jam_masuk, "-", IFNULL(jam_pulang, "00:00:00")), "")) as tgl_11,
            MAX(IF(DAY(tgl_presensi) = 12, CONCAT(jam_masuk, "-", IFNULL(jam_pulang, "00:00:00")), "")) as tgl_12,
            MAX(IF(DAY(tgl_presensi) = 13, CONCAT(jam_masuk, "-", IFNULL(jam_pulang, "00:00:00")), "")) as tgl_13,
            MAX(IF(DAY(tgl_presensi) = 14, CONCAT(jam_masuk, "-", IFNULL(jam_pulang, "00:00:00")), "")) as tgl_14,
            MAX(IF(DAY(tgl_presensi) = 15, CONCAT(jam_masuk, "-", IFNULL(jam_pulang, "00:00:00")), "")) as tgl_15,
            MAX(IF(DAY(tgl_presensi) = 16, CONCAT(jam_masuk, "-", IFNULL(jam_pulang, "00:00:00")), "")) as tgl_16,
            MAX(IF(DAY(tgl_presensi) = 17, CONCAT(jam_masuk, "-", IFNULL(jam_pulang, "00:00:00")), "")) as tgl_17,
            MAX(IF(DAY(tgl_presensi) = 18, CONCAT(jam_masuk, "-", IFNULL(jam_pulang, "00:00:00")), "")) as tgl_18,
            MAX(IF(DAY(tgl_presensi) = 19, CONCAT(jam_masuk, "-", IFNULL(jam_pulang, "00:00:00")), "")) as tgl_19,
            MAX(IF(DAY(tgl_presensi) = 20, CONCAT(jam_masuk, "-", IFNULL(jam_pulang, "00:00:00")), "")) as tgl_20,
            MAX(IF(DAY(tgl_presensi) = 21, CONCAT(jam_masuk, "-", IFNULL(jam_pulang, "00:00:00")), "")) as tgl_21,
            MAX(IF(DAY(tgl_presensi) = 22, CONCAT(jam_masuk, "-", IFNULL(jam_pulang, "00:00:00")), "")) as tgl_22,
            MAX(IF(DAY(tgl_presensi) = 23, CONCAT(jam_masuk, "-", IFNULL(jam_pulang, "00:00:00")), "")) as tgl_23,
            MAX(IF(DAY(tgl_presensi) = 24, CONCAT(jam_masuk, "-", IFNULL(jam_pulang, "00:00:00")), "")) as tgl_24,
            MAX(IF(DAY(tgl_presensi) = 25, CONCAT(jam_masuk, "-", IFNULL(jam_pulang, "00:00:00")), "")) as tgl_25,
            MAX(IF(DAY(tgl_presensi) = 26, CONCAT(jam_masuk, "-", IFNULL(jam_pulang, "00:00:00")), "")) as tgl_26,
            MAX(IF(DAY(tgl_presensi) = 27, CONCAT(jam_masuk, "-", IFNULL(jam_pulang, "00:00:00")), "")) as tgl_27,
            MAX(IF(DAY(tgl_presensi) = 28, CONCAT(jam_masuk, "-", IFNULL(jam_pulang, "00:00:00")), "")) as tgl_28,
            MAX(IF(DAY(tgl_presensi) = 29, CONCAT(jam_masuk, "-", IFNULL(jam_pulang, "00:00:00")), "")) as tgl_29,
            MAX(IF(DAY(tgl_presensi) = 30, CONCAT(jam_masuk, "-", IFNULL(jam_pulang, "00:00:00")), "")) as tgl_30,
            MAX(IF(DAY(tgl_presensi) = 31, CONCAT(jam_masuk, "-", IFNULL(jam_pulang, "00:00:00")), "")) as tgl_31')
        ->join('karyawan', 'presensi.nuptk_absen', '=', 'karyawan.nuptk')
        ->whereMonth('tgl_presensi', '=', $bulan)
        ->whereYear('tgl_presensi', '=', $tahun)
        ->groupBy('presensi.nuptk_absen', 'karyawan.nama')
        ->get();

        if(isset($_POST['exportexcel'])){
            $time = date("d-m-Y H:i:s");

            //fungsi header dengan mengirimkan raw data excel 
            header("Content-tupe: aplication/vnd-ms-excel");

            //definisi nama file export excel
            header("Content-Disposition: attachment; filename=Laporan Absensi Guru $time.xls");
        }

        return view('absensi.getrekap', compact('bulan','tahun','namabulan','rekap'));
    }

    public function datapengajuan(Request $request){
        $izin = pengajuanizin::query();
        $izin->select('id','tgl_izin','izin.nuptk','nama','status','status_approved','keterangan');
        $izin->join('karyawan','izin.nuptk','=','karyawan.nuptk');
        if(!empty($request->tgl)){
            $izin->where('tgl_izin', $request->tgl);
        }

        if(!empty($request->nuptk)){
            $izin->where('izin.nuptk', $request->nuptk);
        }

        if(!empty($request->username)){
            $izin->where('karyawan.nama', $request->username);
        }

        if ($request->status_approved === '0' || $request->status_approved === '1' || $request->status_approved === '2' ) {
            $izin->where('status_approved', $request->status_approved);
        }
        $izin->orderBy('tgl_izin','desc');
        $pengajuan = $izin->get();
        $pengajuan = $izin->paginate(10);


        return view('absensi.datapengajuan', compact('pengajuan'));
    }

    public function approveizinsakit(Request $request){
        $status = $request->status_approved;
        $id_izinsakit_form = $request->id_izinsakit_form;
        $update = DB::table('izin')
        ->where('id',$id_izinsakit_form)->update([
            'status_approved' => $status
        ]);

        $tgl = $request->tgl;
        $absensi = DB::table('presensi')
        ->select('presensi.*','nama')
        ->join('karyawan','presensi.nuptk_absen','=','karyawan.nuptk')
        ->where('tgl_presensi', $tgl)
        ->get();

        if($update){
            return Redirect::back()->with(['success' => 'Data Berhasil Di Update']);
        }else{
            return Redirect::back()->with(['warning' => 'Data Gagal Di Update']);
        }
    }

    public function batalizinsakit($id){
        $update = DB::table('izin')
        ->where('id',$id)->update([
            'status_approved' => 0
        ]);
        if($update){
            return Redirect::back()->with(['success' => 'Data Berhasil Di Update']);
        }else{
            return Redirect::back()->with(['warning' => 'Data Gagal Di Update']);
        }
    } 

    public function pengajuandinas(Request $request){
        $dinas = pengajuandinas::query();
        $dinas->select('id','tgl_mulai','tgl_selesai','dinas.nuptk','nama','tipe_dinas','alamat_dinas','waktu_mulai','waktu_selesai','keterangan','status_approved');
        $dinas->join('karyawan','dinas.nuptk','=','karyawan.nuptk');
        if(!empty($request->mulai) && !empty($request->selesai)){
            $dinas->where('tgl_mulai', $request->mulai)
               ->where('tgl_selesai', $request->selesai)
               ->get();
        }

        if(!empty($request->nuptk)){
            $dinas->where('dinas.nuptk', $request->nuptk);
        }

        if(!empty($request->username)){
            $dinas->where('nama', $request->username);
        }

        if ($request->status_approved === '0' || $request->status_approved === '1' || $request->status_approved === '2' ) {
            $dinas->where('status_approved', $request->status_approved);
        }
        $dinas->orderBy('tgl_mulai','desc');
        $pengajuandinas = $dinas->get();
        $pengajuandinas = $dinas->paginate(10);


        return view('absensi.pengajuandinas', compact('pengajuandinas'));
    }

    public function approveizindinas(Request $request){
        $status = $request->status_approved;
        $id_izindinas_form = $request->id_izindinas_form;
        $update = DB::table('dinas')
        ->where('id',$id_izindinas_form)->update([
            'status_approved' => $status
        ]);
        if($update){
            return Redirect::back()->with(['success' => 'Data Berhasil Di Update']);
        }else{
            return Redirect::back()->with(['warning' => 'Data Gagal Di Update']);
        }
    }

    public function batalizindinas($id){
        $update = DB::table('dinas')
        ->where('id',$id)->update([
            'status_approved' => 0
        ]);
        if($update){
            return Redirect::back()->with(['success' => 'Data Berhasil Di Update']);
        }else{
            return Redirect::back()->with(['warning' => 'Data Gagal Di Update']);
        }
    } 
}
