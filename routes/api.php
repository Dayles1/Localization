<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;



Route::middleware(['auth:sanctum','setLocale'])->group(function(){
    Route::apiResource('posts',PostController::class);
});
Route::middleware('setLocale')->group(function(){
    Route::post('/login',[AuthController::class, 'login']);
    Route::post('/register',[AuthController::class,'register']);
    
});
