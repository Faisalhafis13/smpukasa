<?php

use App\Http\Controllers\Admin\BeritaController as AdminBeritaController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProfilController;
use App\Http\Controllers\Public\BeritaController as PublicBeritaController;
use App\Http\Controllers\Public\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\GaleriController as AdminGaleriController;
use App\Http\Controllers\Public\GaleriController as PublicGaleriController;


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

/*
|--------------------------------------------------------------------------
| ADMIN
|--------------------------------------------------------------------------
*/

Route::prefix('admin')
    ->name('admin.')
    ->group(function () {

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
    });