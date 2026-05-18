<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\BeritaController;
use App\Http\Controllers\Api\EskulController;
use App\Http\Controllers\Api\AgendaController;
use App\Http\Controllers\Api\JurusanController;
use App\Http\Controllers\Api\ChatController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Public API routes
Route::get('/berita', [BeritaController::class, 'index']);
Route::get('/berita/{id}', [BeritaController::class, 'show']);
Route::get('/eskul', [EskulController::class, 'index']);
Route::get('/agenda', [AgendaController::class, 'index']);
Route::get('/jurusan', [JurusanController::class, 'index']);
Route::post('/chat', [ChatController::class, 'store']);
