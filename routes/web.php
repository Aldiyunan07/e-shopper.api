<?php

use App\Http\Controllers\BrandController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\TypeController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\{Route,Auth};

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::resource('user', UserController::class);
Route::resource('product', ProductController::class);
Route::resource('transaction', TransactionController::class);
Route::resource('type', TypeController::class);
Route::resource('setting', SettingController::class);
Route::resource('brand',BrandController::class);
Route::get('product/{product:slug}/tambah', [ProductController::class,'tambah']);
Route::post('product/{product:slug}/insert', [ProductController::class,'insert']);
Route::delete('product/{product}/{gambar}/delete',[ProductController::class,'delete']);
Route::get('/transaction/{id}/set-status', [TransactionController::class,'setStatus'])->name('transaction.status');
Route::get('/mark',[TransactionController::class,'mark'])->name('mark');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
