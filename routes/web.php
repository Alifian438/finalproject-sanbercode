<?php

use App\Http\Controllers\ForumController;
use App\Http\Controllers\profilecontroller;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\downloadpdf;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|s
*/

Route::middleware(['auth'])->group(function () {
    Route::resource('/profile', profilecontroller::class)->only('index', 'update', 'edit');
    Route::resource('forum', ForumController::class);
    Route::resource('kategori', KategoriController::class);
    Route::get('/', [ForumController::class, 'index']);
    Route::get('/kategori-pdf', [downloadpdf::class, 'pdf']);
    Route::post('/forum/{forum}', [ForumController::class, 'komentar']);
});






Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
