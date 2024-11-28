<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable; // Use this instead of Model
use Illuminate\Notifications\Notifiable;

class Karyawan extends Authenticatable
{
    use HasFactory, Notifiable;  // Use HasFactory and Notifiable traits

    protected $table = 'karyawans';
    protected $primaryKey = 'nuptk';
    public $incrementing = false;  // Prevents auto-incrementing since nuptk is a string
    protected $keyType = 'string';

    protected $fillable = [
        'nuptk', 'nama', 'jabatan', 'no_hp', 'foto', 'password', 'remember_login',  'reset_token'
    ];

    // Ensure 'password' is hidden when serialized (optional, but recommended)
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function dinas()
    {
        return $this->hasMany(Dinas::class, 'nuptk');
    }

    public function izin()
    {
        return $this->hasMany(Izin::class, 'nuptk');
    }

    public function presensi()
    {
        return $this->hasMany(Presensi::class, 'nuptk_absen');
    }
}
