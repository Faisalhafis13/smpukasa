<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PendaftaranSpmb extends Model
{
    protected $fillable = [
        'nama_lengkap',
        'nisn',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'asal_sekolah',
        'alamat',
        'nama_orang_tua',
        'no_hp',
        'email',
        'status',
    ];

    protected $casts = [
        'tanggal_lahir' => 'date',
    ];
}