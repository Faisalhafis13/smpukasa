<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('spmbs', function (Blueprint $table) {
            $table->id();

            $table->string('judul');

            $table->text('deskripsi')->nullable();

            $table->date('tanggal_mulai')->nullable();

            $table->date('tanggal_selesai')->nullable();

            $table->string('status')->default('Belum Dibuka');

            $table->longText('persyaratan')->nullable();

            $table->longText('alur_pendaftaran')->nullable();

            $table->string('link_pendaftaran')->nullable();

            $table->string('kontak')->nullable();

            $table->string('gambar')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('spmbs');
    }
};