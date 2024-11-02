<?php

namespace App\Http\Controllers;

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::prefix('dashboard')->group(
    function () {
        // return Inertia::render('Dashboard');
        Route::get('/', [DashboardController::class, 'home'])->name('dashboard');

        // Materi
        Route::prefix('materi')->group(
            function () {
                Route::post('/store', [MateriController::class, 'store'])->name('dashboard.materi.store');
                Route::post('/image-upload', [MateriController::class, 'uploadImage'])->name('dashboard.materi.image.upload');
            }
        );
    }
)->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
