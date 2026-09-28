<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prestasi extends Model
{
    protected $table = 'prestasis';

    protected $fillable = [
        'judul',
        'deskripsi',
        'tingkat',
        'kategori',
        'peraih',
        'penyelenggara',
        'tahun',
        'gambar',
    ];
}