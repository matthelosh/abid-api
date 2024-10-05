<?php

use App\Http\Controllers\BabController;
use App\Http\Controllers\MateriController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix("abid")->group(
    function () {
        Route::get('/bab', [BabController::class, 'index']);

        Route::get('/materi', [MateriController::class, 'index']);
    }
);
