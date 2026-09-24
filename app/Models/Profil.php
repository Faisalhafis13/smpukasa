<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profil extends Model
{
    protected $table = 'profils';

    protected $fillable = [
        'nama_sekolah',
        'npsn',
        'alamat',
        'telepon',
        'email',
        'kepala_sekolah',
        'sambutan',
        'deskripsi',
        'sejarah',
        'visi',
        'misi',
        'logo',
        'foto_kepala',
    ];
}