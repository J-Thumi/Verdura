<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LandscapeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PlantController;
use App\Http\Controllers\PotController;

Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/services', [PageController::class, 'services'])->name('services');
Route::get('/our-work', [PageController::class, 'work'])->name('work');
Route::get('/plants', [PlantController::class, 'index'])->name('plants.index');
Route::get('/plants/{category}', [PlantController::class, 'category'])->name('plants.category');
Route::get('/pots', [PotController::class, 'index'])->name('pots.index');
Route::get('/areas-we-serve', [PageController::class, 'areas'])->name('areas');
Route::get('/about', [PageController::class, 'about'])->name('about');

Route::get('/pots/{pot:slug}', [PotController::class, 'show'])->name('pots.show');
Route::get('/plant/{plant:slug}', [PlantController::class, 'show'])->name('plants.show');