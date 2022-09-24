<?php

use App\Http\Controllers\Api\CartController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\TypeController;
use App\Http\Controllers\Auth\MeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Auth::loginUsingId(1);
Route::get('product',[ProductController::class,'index']);
Route::get('type',[TypeController::class,'index']);

Route::middleware('auth:sanctum')->group(function(){
    Route::get('me',[MeController::class, '__invoke']);
    Route::get('cart',[CartController::class, 'index']);
    Route::get('cart/{product:slug}', [CartController::class ,'store']);
    Route::get('cart/{product:slug}/remove', [CartController::class ,'destroy']);
    Route::post('cart/{product:slug}/action', [CartController::class ,'action']);
});