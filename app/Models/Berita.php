<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{
    protected $table = 'beritas';

    protected $fillable = [
        'judul',
        'slug',
        'kategori',
        'ringkasan',
        'isi',
        'gambar',
        'tanggal_publish',
        'status',
    ];

    protected $casts = [
        'tanggal_publish' => 'date',
    ];
}