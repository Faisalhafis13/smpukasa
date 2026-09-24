<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('profils', function (Blueprint $table) {
            $table->id();

            $table->string('nama_sekolah');
            $table->string('npsn')->nullable();
            $table->string('alamat')->nullable();
            $table->string('telepon')->nullable();
            $table->string('email')->nullable();

            $table->string('kepala_sekolah')->nullable();
            $table->text('sambutan')->nullable();

            $table->text('deskripsi')->nullable();
            $table->longText('sejarah')->nullable();

            $table->text('visi')->nullable();
            $table->longText('misi')->nullable();

            $table->string('logo')->nullable();
            $table->string('foto_kepala')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('profils');
    }
};