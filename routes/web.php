<?php

use App\Http\Controllers\AllergeenController;
use App\Http\Controllers\LeverantieController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MagazijnmedewerkerController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MagazijnController;
use App\Http\Controllers\LeverancierController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/magazijnmedewerker', [MagazijnmedewerkerController::class, 'index'])
    ->middleware(['auth', 'role'])
    ->name('magazijnmedewerker');

Route::middleware('auth')->group(function () {
    Route::get('/magazijn', [MagazijnController::class, 'index'])
    ->middleware(['auth', 'role'])
    ->name('magazijn.index');
     // Leverantie informatie van een product
    Route::get('/magazijn/{productId}/leverantie', [LeverantieController::class, 'show'])
        ->middleware(['auth', 'role'])
        ->name('leverantie.show');
        // Allergeneninformatie van een product
Route::get('/magazijn/{productId}/allergenen', [AllergeenController::class, 'show'])
    ->middleware(['auth', 'role'])
    ->name('allergeen.show');

    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
});
Route::get('/leveranciers', [LeverancierController::class, 'index'])
    ->middleware(['auth', 'role'])
    ->name('leveranciers.index');
require __DIR__.'/auth.php';