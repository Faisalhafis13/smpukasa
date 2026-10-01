<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pendaftaran_spmbs', function (Blueprint $table) {
            $table->id();
            $table->string('nama_lengkap');
            $table->string('nisn', 10)->nullable()->index();
            $table->string('tempat_lahir', 100);
            $table->date('tanggal_lahir');
            $table->string('jenis_kelamin', 1);
            $table->string('asal_sekolah');
            $table->text('alamat');
            $table->string('nama_orang_tua');
            $table->string('no_hp', 30);
            $table->string('email')->nullable();
            $table->string('status')->default('Menunggu Verifikasi');
            $table->timestamps();

            $table->index(['status', 'created_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pendaftaran_spmbs');
    }
};