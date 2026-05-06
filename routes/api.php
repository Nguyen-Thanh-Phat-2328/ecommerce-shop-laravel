<?php

use App\Http\Controllers\Api\BlogController;
use App\Http\Controllers\Api\BrandController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\MemberController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/blogs', [BlogController::class, 'getBlog']);
Route::get('/blogs/{id}', [BlogController::class, 'getBlogById']);

Route::post('/login', [MemberController::class, 'login']);
Route::post('/register', [MemberController::class, 'register']);

Route::middleware(['auth:sanctum'])->group(function() {
    Route::get('/brands', [BrandController::class,'getBrand']);
    Route::post('/brands', [BrandController::class,'createBrand']);

    Route::get('/categories', [CategoryController::class,'getCategory']);
    Route::post('/categories', [CategoryController::class,'createCategory']);   
});