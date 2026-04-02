<?php

use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\CountryController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Frontend\BlogController as FrontendBlogController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\MemberController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/admin/dashboard', [DashboardController::class, 'index']);

//profile
Route::get('/admin/profile', [ProfileController::class, 'index']);
Route::post('/admin/profile', [ProfileController::class, 'update']);

//country
Route::get('/admin/country', [CountryController::class, 'index']);

Route::get('/admin/country/add', [CountryController::class, 'add']);
Route::post('/admin/country/add', [CountryController::class, 'insert']);

Route::get('/admin/country/edit/{id}', [CountryController::class, 'edit']);
Route::post('/admin/country/edit/{id}', [CountryController::class, 'update']);

Route::get('/admin/country/delete/{id}', [CountryController::class, 'delete']);

//blog
Route::get('/admin/blog', [BlogController::class, 'index']);

Route::get('/admin/blog/add', [BlogController::class, 'add']);
Route::post('/admin/blog/add', [BlogController::class, 'insert']);

Route::get('/admin/blog/edit/{id}', [BlogController::class, 'edit']);
Route::post('/admin/blog/edit/{id}', [BlogController::class, 'update']);

Route::get('/admin/blog/delete/{id}', [BlogController::class, 'delete']);

//
Auth::routes();
Route::get('/home', [App\Http\Controllers\Admin\HomeController::class, 'index'])->name('home');

//Frontend
Route::get('/frontend/home', [HomeController::class, 'index']);

//register, login
Route::get('/frontend/register', [MemberController::class, 'registerView']);
Route::post('/frontend/register', [MemberController::class, 'register']);

Route::get('/frontend/login', [MemberController::class, 'loginView']);
Route::post('/frontend/login', [MemberController::class, 'login']);

//blog
Route::get('/frontend/blog', [FrontendBlogController::class, 'index']);

Route::get('/frontend/blog/detail/{id}', [FrontendBlogController::class, 'blogDetail']);

//blog rate ajax
Route::post('/frontend/blog/rate/ajax', [FrontendBlogController::class, 'blogRateAjax']);