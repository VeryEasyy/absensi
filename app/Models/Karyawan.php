<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Karyawan extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = "karyawan";

    public $timestamps = false;

    protected $primaryKey = "nuptk";
 
    protected $fillable = [
        'nuptk',
        'nama',
        'jabatan',
        'no_hp',
        'password',
    ];
    protected $hidden = [
        'password',
        'remember_login',
    ];
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
