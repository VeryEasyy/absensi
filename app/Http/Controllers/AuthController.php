<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Karyawan;
use App\Models\User;
use Illuminate\Console\View\Components\Alert;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;


class AuthController extends Controller
{
    public function proseslogin(Request $request){

        $request->validate([
            'nuptk' => 'required|string',
            'password' => 'required|string',
        ], [
            'nuptk.required' => 'NUPTK tidak boleh kosong.',
            'password.required' => 'Password tidak boleh kosong.',
        ]);

        if (Auth::guard("karyawan")->attempt(['nuptk' => $request->nuptk, 'password' => $request->password])) {
            return redirect('/dashboard');
        }else {
            return redirect('/')->with(['danger'=>'NUPTK / Password Salah']);
            
        }

    }

    public function logout(){
        if (Auth::guard('karyawan')->check()) {
            Auth::guard('karyawan')->logout();
            return redirect('/');
        }
    }

    public function prosesloginadmin(Request $request){
        if (Auth::guard("user")->attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect('/admin/dashboardadmin');
        }else {
            return redirect('/admin')->with(['warning'=>'Email / Password Salah']);
            
        }
    }

    public function logoutadmin(){
        if (Auth::guard('user')->check()) {
            Auth::guard('user')->logout();
            return redirect('/admin');
        }
    }

    public function register(){


        return view('auth.register');
    }

    public function prosesregister(Request $request){

        $nuptk = $request->nuptk;
        $nama = $request->nama;
        $jabatan = $request->jabatan;
        $no_hp = $request->no_hp;
        $pass = Hash::make($request->password);

      $validateData = $request->validate([
            'nuptk' => ['required', 'min:4', 'max:255', 'unique:karyawans'],
            'nama' => 'required|max:255',
            'jabatan' => 'required|max:255',
            'no_hp' => 'required|max:15|unique:karyawans',
            'password' => 'required|min:5|max:255|confirmed' 
       ]);


       $data = [
        'nuptk' => $nuptk,
        'nama' => $nama,
        'jabatan' => $jabatan,
        'no_hp' => $no_hp,
        'foto' => "",
        'password' => $pass
    ];

    $simpan = DB::table('karyawans')->insert($data);

    if($simpan){
        return Redirect::back()->with(['success' => 'Akun Berhasil Dibuat']);
    }else{
        return Redirect::back()->with(['error' => 'Akun Gagal Dibuat Harap Coba Lagi']);
    }


    }

    public function registeradmin(){


        return view('auth.registeradmin');
    }

    public function prosesregisteradmin(Request $request){

        $email = $request->email;
        $nama = $request->nama;
        $pass = Hash::make($request->password);

      $validateData = $request->validate([
            'nama' => 'required|max:255',
            'email' => ['required', 'email', 'max:255', 'unique:users'],
            'password' => 'required|min:5|max:255|confirmed' 
       ]);


       $data = [
        'name' => $nama,
        'email' => $email,
        'password' => $pass

    ];

    $simpan = DB::table('users')->insert($data);

    if($simpan){
        return Redirect::back()->with(['success' => 'Akun Berhasil Dibuat']);
    }else{
        return Redirect::back()->with(['error' => 'Akun Gagal Dibuat Harap Coba Lagi']);
    }

    }

    // public function editpassword()
    // {
    //     // $nuptk = Auth::guard('karyawan')->user()->nuptk;
    //     // $guru = DB::table('karyawans')->where('nuptk', $nuptk)->first();
    //     // if (!$guru) {
    //     //     return redirect()->route('home')->with('error', 'NUPTK tidak ditemukan.');
    //     // }
    

    //     return view('absensi.editpassword');
    // }

    // public function updatepass(Request $request){
    //     $nuptk = Auth::guard('karyawan')->user()->nuptk;
    //     $pass1 = $request->password1;
    //     $pass2 = $request->password2;

    //     if($pass1 !== $pass2){
    //         return Redirect::back()->with(['info' => 'Konfirmasi Password Tidak Sesuai']);
    //     }
    //         $pass1 = Hash::make($request->password1);
    //         $data = [
    //                 'password' => $pass1,
    //             ];

    //     $update = DB::table('karyawans')->where('nuptk',$nuptk)->update($data);
    //     if($update){
    //         return Redirect::back()->with(['success'=>'Password Berhasil Di Ganti']);
    //     }else{
    //         return Redirect::back()->with(['error'=>'Password Gagal Diganti']);;
    //     }
    // }


    public function showForgotPasswordForm()
    {
        return view('auth.forgotpassword');
    }

    public function sendResetLink(Request $request)
    {
        $request->validate([
            'nuptk' => 'required|exists:karyawans,nuptk', // Pastikan nama tabel dan kolom sesuai
        ], [
            'nuptk.exists' => 'NUPTK tidak ditemukan.',
        ]);
    
        $user = Karyawan::where('nuptk', $request->nuptk)->first();
    
        // Simpan token reset password
        $token = Str::random(60);
        $user->update([
            'reset_token' => $token,
        ]);
    
        return redirect()->route('password.reset.form', $token)
            ->with('warning', 'Silakan atur ulang password Anda.');
    }

    // Menampilkan form reset password
    public function showResetForm($token)
    {
        return view('auth.resetpassword', compact('token'));
    }

    // Proses reset password
    public function resetPassword(Request $request)
    {
        $request->validate([
            'password' => 'required|confirmed|min:6',
            'token' => 'required|exists:karyawans,reset_token',
        ]);

        $user = Karyawan::where('reset_token', $request->token)->first();

        if (!$user) {
            return redirect()->back()->withErrors(['token' => 'Token reset tidak valid.']);
        }

        $user->update([
            'password' => Hash::make($request->password),
            'reset_token' => null, // Hapus token setelah reset password
        ]);

        
        if($user){
            return Redirect::back()->with(['success' => 'Password Berhasil Di Ganti']);
        }else{
            return Redirect::back()->with(['error' => 'Password Gagal Di Ganti']);
          
        }
    }



}