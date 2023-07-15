<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class kehadiran extends Model
{
    protected $table = 'kehadiran';
    protected $fillable = [
        'id_siswa',
        'kd_pelajaran',
        'id_pelajaran',
        'tanggal',
        'status_kehadiran',
    ];
}
