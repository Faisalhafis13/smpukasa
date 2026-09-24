<?php

use App\Http\Controllers\Public\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/home', [HomeController::class, 'apiIndex'])
    ->name('api.home');