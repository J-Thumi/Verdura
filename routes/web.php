<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LandscapeController;

Route::get('/', [LandscapeController::class, 'index'])->name('home');