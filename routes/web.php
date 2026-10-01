<?php

use App\Http\Controllers\Admin\BeritaController as AdminBeritaController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProfilController;
use App\Http\Controllers\Admin\AuthController as AdminAuthController;
use App\Http\Controllers\Public\BeritaController as PublicBeritaController;
use App\Http\Controllers\Public\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\GaleriController as AdminGaleriController;
use App\Http\Controllers\Public\GaleriController as PublicGaleriController;
use App\Http\Controllers\Admin\AgendaController as AdminAgendaController;
use App\Http\Controllers\Public\AgendaController as PublicAgendaController;
use App\Http\Controllers\Admin\PrestasiController as AdminPrestasiController;
use App\Http\Controllers\Public\PrestasiController as PublicPrestasiController;
use App\Http\Controllers\Admin\FasilitasController as AdminFasilitasController;
use App\Http\Controllers\Public\FasilitasController as PublicFasilitasController;
use App\Http\Controllers\Admin\GuruController as AdminGuruController;
use App\Http\Controllers\Public\GuruController as PublicGuruController;
use App\Http\Controllers\Admin\ProgramController as AdminProgramController;
use App\Http\Controllers\Public\ProgramController as PublicProgramController;
use App\Http\Controllers\Admin\SpmbController as AdminSpmbController;
use App\Http\Controllers\Public\SpmbController as PublicSpmbController;
use App\Http\Controllers\Public\PendaftaranSpmbController as PublicPendaftaranSpmbController;
use App\Http\Controllers\Admin\PendaftarSpmbController as AdminPendaftarSpmbController;
use App\Http\Controllers\Public\ProfilController as PublicProfilController;

/*
|--------------------------------------------------------------------------
| PUBLIC
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index'])
    ->name('home');

Route::get('/berita', [PublicBeritaController::class, 'index'])
    ->name('berita.index');

Route::get('/berita/{slug}', [PublicBeritaController::class, 'show'])
    ->name('berita.show');

    Route::get('/galeri', [PublicGaleriController::class, 'index'])
    ->name('galeri.index');


    Route::get('/agenda', [PublicAgendaController::class, 'index'])
    ->name('agenda.index');

Route::get('/prestasi', [PublicPrestasiController::class, 'index'])
    ->name('prestasi.index');

    Route::get('/fasilitas', [PublicFasilitasController::class, 'index'])
    ->name('fasilitas.index');

Route::get('/guru', [PublicGuruController::class, 'index'])
    ->name('guru.index');

Route::get('/program', [PublicProgramController::class, 'index'])
    ->name('program.index');

Route::get('/spmb/pendaftaran', [PublicPendaftaranSpmbController::class, 'create'])
    ->name('spmb.pendaftaran.create');

Route::post('/spmb/pendaftaran', [PublicPendaftaranSpmbController::class, 'store'])
    ->middleware('throttle:5,1')
    ->name('spmb.pendaftaran.store');

Route::get('/spmb', [PublicSpmbController::class, 'index'])
    ->name('spmb.index');

    Route::get('/profil', [PublicProfilController::class, 'index'])
    ->name('profil.index');

/*
|--------------------------------------------------------------------------
| ADMIN
|--------------------------------------------------------------------------
*/

Route::middleware('guest')->group(function () {
    Route::get('/admin/login', [AdminAuthController::class, 'create'])
        ->name('admin.login');

    Route::post('/admin/login', [AdminAuthController::class, 'store'])
        ->name('admin.login.store');
});

Route::prefix('admin')
    ->name('admin.')
    ->middleware('auth')
    ->group(function () {

        Route::post('/logout', [AdminAuthController::class, 'destroy'])
            ->name('logout');

        Route::get('/pendaftar', [AdminPendaftarSpmbController::class, 'index'])
            ->name('pendaftar.index');

        Route::patch('/pendaftar/{id}', [AdminPendaftarSpmbController::class, 'updateStatus'])
            ->whereNumber('id')
            ->name('pendaftar.update');

        Route::get('/dashboard', [DashboardController::class, 'index'])
            ->name('dashboard');


        /*
        |--------------------------------------------------------------------------
        | Profil
        |--------------------------------------------------------------------------
        */

        Route::get('/profil', [ProfilController::class, 'index'])
            ->name('profil.index');

        Route::post('/profil', [ProfilController::class, 'store'])
            ->name('profil.store');

        Route::get('/profil/{id}', [ProfilController::class, 'show'])
            ->name('profil.show');

        Route::put('/profil/{id}', [ProfilController::class, 'update'])
            ->name('profil.update');

        Route::delete('/profil/{id}', [ProfilController::class, 'destroy'])
            ->name('profil.destroy');


        /*
        |--------------------------------------------------------------------------
        | Berita
        |--------------------------------------------------------------------------
        */

        Route::get('/berita', [AdminBeritaController::class, 'index'])
            ->name('berita.index');

        Route::post('/berita', [AdminBeritaController::class, 'store'])
            ->name('berita.store');

        Route::get('/berita/{id}', [AdminBeritaController::class, 'show'])
            ->name('berita.show');

        Route::put('/berita/{id}', [AdminBeritaController::class, 'update'])
            ->name('berita.update');

        Route::delete('/berita/{id}', [AdminBeritaController::class, 'destroy'])
            ->name('berita.destroy');



            Route::get('/galeri', [AdminGaleriController::class, 'index'])
    ->name('galeri.index');

Route::post('/galeri', [AdminGaleriController::class, 'store'])
    ->name('galeri.store');

Route::get('/galeri/{id}', [AdminGaleriController::class, 'show'])
    ->name('galeri.show');

Route::put('/galeri/{id}', [AdminGaleriController::class, 'update'])
    ->name('galeri.update');

Route::delete('/galeri/{id}', [AdminGaleriController::class, 'destroy'])
    ->name('galeri.destroy');



    Route::get('/agenda', [AdminAgendaController::class, 'index'])
    ->name('agenda.index');

Route::post('/agenda', [AdminAgendaController::class, 'store'])
    ->name('agenda.store');

Route::get('/agenda/{id}', [AdminAgendaController::class, 'show'])
    ->name('agenda.show');

Route::put('/agenda/{id}', [AdminAgendaController::class, 'update'])
    ->name('agenda.update');

Route::delete('/agenda/{id}', [AdminAgendaController::class, 'destroy'])
    ->name('agenda.destroy');


Route::get('/prestasi', [AdminPrestasiController::class, 'index'])
    ->name('prestasi.index');

Route::post('/prestasi', [AdminPrestasiController::class, 'store'])
    ->name('prestasi.store');

Route::get('/prestasi/{id}', [AdminPrestasiController::class, 'show'])
    ->name('prestasi.show');

Route::put('/prestasi/{id}', [AdminPrestasiController::class, 'update'])
    ->name('prestasi.update');

Route::delete('/prestasi/{id}', [AdminPrestasiController::class, 'destroy'])
    ->name('prestasi.destroy');

Route::get('/fasilitas', [AdminFasilitasController::class, 'index'])
    ->name('fasilitas.index');

Route::post('/fasilitas', [AdminFasilitasController::class, 'store'])
    ->name('fasilitas.store');

Route::get('/fasilitas/{id}', [AdminFasilitasController::class, 'show'])
    ->name('fasilitas.show');

Route::put('/fasilitas/{id}', [AdminFasilitasController::class, 'update'])
    ->name('fasilitas.update');

Route::delete('/fasilitas/{id}', [AdminFasilitasController::class, 'destroy'])
    ->name('fasilitas.destroy');

Route::get('/guru', [AdminGuruController::class, 'index'])
    ->name('guru.index');

Route::post('/guru', [AdminGuruController::class, 'store'])
    ->name('guru.store');

Route::get('/guru/{id}', [AdminGuruController::class, 'show'])
    ->name('guru.show');

Route::put('/guru/{id}', [AdminGuruController::class, 'update'])
    ->name('guru.update');

Route::delete('/guru/{id}', [AdminGuruController::class, 'destroy'])
    ->name('guru.destroy');

Route::get('/program', [AdminProgramController::class, 'index'])
    ->name('program.index');

Route::post('/program', [AdminProgramController::class, 'store'])
    ->name('program.store');

Route::get('/program/{id}', [AdminProgramController::class, 'show'])
    ->name('program.show');

Route::put('/program/{id}', [AdminProgramController::class, 'update'])
    ->name('program.update');

Route::delete('/program/{id}', [AdminProgramController::class, 'destroy'])
    ->name('program.destroy');

Route::get('/spmb', [AdminSpmbController::class, 'index'])
    ->name('spmb.index');

Route::post('/spmb', [AdminSpmbController::class, 'store'])
    ->name('spmb.store');

Route::get('/spmb/{id}', [AdminSpmbController::class, 'show'])
    ->name('spmb.show');

Route::put('/spmb/{id}', [AdminSpmbController::class, 'update'])
    ->name('spmb.update');

Route::delete('/spmb/{id}', [AdminSpmbController::class, 'destroy'])
    ->name('spmb.destroy');


    });