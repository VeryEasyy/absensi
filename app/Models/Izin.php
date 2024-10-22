<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Izin extends Model
{
    use HasFactory;

    protected $fillable = [
        'nuptk', 'tgl_izin', 'status', 'keterangan', 'status_approved'
    ];

    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class, 'nuptk');
    }
}
