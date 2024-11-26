<?php

use App\Http\Controllers\BrandController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->group(function () {
    // Route::resource('category', CategoryController::class);
    Route::resource('products', ProductController::class);  
    Route::resource('category', CategoryController::class);
    Route::resource('brand', BrandController::class);
    Route::post('logout', [UserController::class, 'logout']);
    
});

Route::post('login', [UserController::class, 'login']);
Route::post('register', [UserController::class, 'register']);


// Route::resource('users', UserController::class);