<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    protected $table = 'gurus';

    protected $fillable = [
        'nama',
        'jabatan',
        'mata_pelajaran',
        'pendidikan',
        'foto',
        'deskripsi',
    ];
}