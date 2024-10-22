<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Presensi extends Model
{
    use HasFactory;

    protected $fillable = [
        'nuptk_absen', 'tgl_presensi', 'hari', 'jam_masuk', 
        'jam_pulang', 'foto_masuk', 'foto_pulang', 'lokasi_masuk', 
        'lokasi_pulang'
    ];

    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class, 'nuptk_absen');
    }
}
