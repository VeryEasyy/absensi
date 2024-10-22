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

class AuthController extends Controller
{
    public function proseslogin(Request $request){
        if (Auth::guard("karyawan")->attempt(['nuptk' => $request->nuptk, 'password' => $request->password])) {
            return redirect('/dashboard');
        }else {
            return redirect('/')->with(['warning'=>'NUPTK / Password Salah']);
            
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


}