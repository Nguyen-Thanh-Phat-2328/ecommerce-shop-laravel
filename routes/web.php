<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('admin.dashboard');
// });

Route::get('/admin/dashboard', [DashboardController::class, 'index']);
Route::get('/admin/profile', [UserController::class, 'index']);
