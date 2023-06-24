<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    use HasFactory;
    protected $table = 'guru';
    protected $fillable = [
        'id_users',
        'tgl_lahir',
        'pendidikan',
        'tmk',
        'jabatan',
        'alamat',
        'tgs_tam',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_users');
    }
}
