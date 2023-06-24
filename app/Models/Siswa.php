<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;
    protected $table = 'siswa';
    protected $fillable = [
        'id_users',
        'id_kelas',
        'hp',
        'alamat',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function guru()
    {
        return $this->hasMany(Guru::class, 'id_users');
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'id_kelas');
    }

    public function nilai()
    {
        return $this->hasOne(Nilai::class, 'id_users');
    }
}
