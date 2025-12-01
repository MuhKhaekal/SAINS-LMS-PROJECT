<?php

use App\Http\Controllers\Asisten\MaterialController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Praktikan\ProfilePraktikanController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', [HomeController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile-praktikan', [ProfilePraktikanController::class, 'edit'])->name('profile-praktikan.edit');
    Route::patch('/profile-praktikan', [ProfilePraktikanController::class, 'update'])->name('profile-praktikan.update');
    Route::delete('/profile-praktikan', [ProfilePraktikanController::class, 'destroy'])->name('profile-praktikan.destroy');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/materi-asisten/preview/{filename}', [MaterialController::class, 'preview'])
    ->name('materi-asisten.preview');




require __DIR__.'/auth.php';
