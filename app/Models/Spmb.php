<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Spmb extends Model
{
    protected $table = 'spmbs';

    protected $fillable = [
        'judul',
        'deskripsi',
        'tanggal_mulai',
        'tanggal_selesai',
        'status',
        'persyaratan',
        'alur_pendaftaran',
        'link_pendaftaran',
        'kontak',
        'gambar',
    ];

    protected $casts = [
        'tanggal_mulai' => 'date',
        'tanggal_selesai' => 'date',
    ];
}