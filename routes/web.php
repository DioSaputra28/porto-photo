<?php

use App\Http\Controllers\WebController;
use App\Http\Controllers\GaleryController;
use Illuminate\Support\Facades\Route;

Route::get('/', [WebController::class, 'index'])->name('home');
Route::get('/gallery', [GaleryController::class, 'index'])->name('gallery');
Route::post('/gallery/{id}/track-view', [GaleryController::class, 'trackView'])->name('gallery.track-view');
Route::post('/gallery/{id}/track-download', [GaleryController::class, 'trackDownload'])->name('gallery.track-download');
Route::get('/gallery/{id}/download', [GaleryController::class, 'download'])->name('gallery.download');
Route::get('/contact', [WebController::class, 'contact'])->name('contact');
Route::get('/services', [WebController::class, 'services'])->name('services');
