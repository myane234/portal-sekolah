<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('admin/berita', \App\Http\Controllers\Admin\BeritaController::class)->names([
        'index' => 'admin.berita.index',
        'create' => 'admin.berita.create',
        'store' => 'admin.berita.store',
        'edit' => 'admin.berita.edit',
        'update' => 'admin.berita.update',
        'destroy' => 'admin.berita.destroy',
    ]);
    Route::resource('admin/eskul', \App\Http\Controllers\Admin\EskulController::class)->names([
        'index' => 'admin.eskul.index',
        'create' => 'admin.eskul.create',
        'store' => 'admin.eskul.store',
        'edit' => 'admin.eskul.edit',
        'update' => 'admin.eskul.update',
        'destroy' => 'admin.eskul.destroy',
    ]);
    Route::resource('admin/agenda', \App\Http\Controllers\Admin\AgendaController::class)->names([
        'index' => 'admin.agenda.index',
        'create' => 'admin.agenda.create',
        'store' => 'admin.agenda.store',
        'edit' => 'admin.agenda.edit',
        'update' => 'admin.agenda.update',
        'destroy' => 'admin.agenda.destroy',
    ]);
});

require __DIR__.'/auth.php';
