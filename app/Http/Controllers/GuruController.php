<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class GuruController extends Controller
{
    public function index(Request $request)
    {
        $query = Karyawan::query();
        $query->select('karyawans.*');
        $query->orderBy('nama');

        if(!empty($request->nama_guru)){
            $query->where('nuptk', 'like', '%' . $request->nama_guru . '%')
            ->orWhere('nama', 'like', '%' . $request->nama_guru . '%');
        }

        $guru = $query->paginate(10);

        return view('guru.index', compact('guru'));
    }

    public function edit(Request $request){
        $nuptk = $request->nuptk;

        $guru = DB::table('karyawans')
        ->where('nuptk', $nuptk)
        ->first();

        

        return view('guru.edit', compact('guru'));
    }

    public function update($nuptk, Request $request){
        $nuptk = $request->nuptk;
        $nama = $request->nama;
        $jabatan = $request->jabatan;
        $no_hp = $request->no_hp;


        try {
            $data = [
                'nuptk' => $nuptk,
                'nama' => $nama,
                'jabatan' => $jabatan,
                'no_hp' => $no_hp
            ];
            $update = DB::table('karyawans')->where('nuptk',$nuptk)->update($data);

            if($update) {
                return Redirect::back()->with(['success' => 'Data Berhasil Diedit']);
            }

        } catch (\Exception $e) {
            return Redirect::back()->with(['success' => 'Data Gagal Diedit']);
            
        }
    }

    public function delete($nuptk, Request $request){
        $delete = DB::table('karyawans')
        ->where('nuptk', $nuptk)
        ->delete();

        if($delete) {
            return Redirect::back()->with(['success' => 'Data Berhasil Dihapus']);
        }else{
            return Redirect::back()->with(['error' => 'Data Gagal Dihapus']);
        }
    }
}
