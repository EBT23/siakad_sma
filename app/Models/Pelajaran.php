<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelajaran extends Model
{
    use HasFactory;

    protected $table = 'pelajaran';
    protected $fillable = [
        'nama',
        'kode',
        'kelompok'
    ];

    public function nilai()
    {
        return $this->hasMany(Nilai::class, 'kd_pelajaran');
    }
}
