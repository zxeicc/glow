<?php

use App\Http\Controllers\Api\Authentication\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// authontication register,login,logout
Route::post('/login',[AuthController::class,('login')]);

Route::post('/register',[AuthController::class,('register')]);
Route::middleware('auth:sanctum')->post('/logout',[AuthController::class, 'logout']);
