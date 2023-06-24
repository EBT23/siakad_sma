<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nilai extends Model
{
    use HasFactory;
    protected $table = 'nilai';
    protected $fillable = [
        'id_users',
        'kd_pelajaran',
        'rph',
        'pts',
        'pat',
        'jumlah',
        'rata_rata',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_users');
    }

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'id_users');
    }

    public function pelajaran()
    {
        return $this->belongsTo(Siswa::class, 'kd_pelajaran');
    }
}
