<?php

use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CountryController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Frontend\BlogController as FrontendBlogController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\MemberController;
use App\Http\Controllers\Frontend\ProductController;
use App\Http\Controllers\Frontend\SearchAdvancedController;
use App\Http\Controllers\Frontend\SearchController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\SearchPriceController;
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

//category
Route::get('/admin/category', [CategoryController::class, 'index']);
Route::get('/admin/category/add', [CategoryController::class, 'add']);
Route::post('/admin/category/add', [CategoryController::class, 'insert']);

Route::get('/admin/category/edit/{id}', [CategoryController::class, 'edit']);
Route::post('/admin/category/edit/{id}', [CategoryController::class, 'update']);

Route::get('/admin/category/delete/{id}', [CategoryController::class, 'delete']);

//brand
Route::get('/admin/brand', [BrandController::class, 'index']);
Route::get('/admin/brand/add', [BrandController::class, 'add']);
Route::post('/admin/brand/add', [BrandController::class, 'insert']);

Route::get('/admin/brand/edit/{id}', [BrandController::class, 'edit']);
Route::post('/admin/brand/edit/{id}', [BrandController::class, 'update']);

Route::get('/admin/brand/delete/{id}', [BrandController::class, 'delete']);

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

Route::get('/frontend/logout', [MemberController::class, 'logout']);

//blog
Route::get('/frontend/blog', [FrontendBlogController::class, 'index']);

Route::get('/frontend/blog/detail/{id}', [FrontendBlogController::class, 'blogDetail']);

//blog rate ajax
Route::post('/frontend/blog/rate/ajax', [FrontendBlogController::class, 'blogRateAjax']);
//blog comment ajax
Route::post('/frontend/blog/comment/ajax', [FrontendBlogController::class, 'blogCommentAjax']);

//account
Route::get('/frontend/account/update', [ProductController::class, 'profileView']);
Route::post('/frontend/account/update', [ProductController::class, 'profileUpdate']);

//my product
Route::get('/frontend/account/my-product', [ProductController::class, 'myProduct']);
//add product
Route::get('/frontend/account/add-product', [ProductController::class, 'addProduct']);
Route::post('/frontend/account/add-product', [ProductController::class, 'insertProduct']);

//edit product
Route::get('/frontend/account/edit-product/{id}', [ProductController::class, 'editProduct']);
Route::post('/frontend/account/edit-product/{id}', [ProductController::class, 'updateProduct']);

Route::get('/frontend/account/delete-product/{id}', [ProductController::class, 'deleteProduct']);

//product detail
Route::get('/frontend/product/detail/{id}', [ProductController::class, 'productDetail']);

//CART
//add to cart
Route::post('/frontend/add-to-cart/ajax', [CartController::class, 'addToCartAjax']);
Route::post('/frontend/up-date-cart/ajax', [CartController::class, 'cartUpdate']);

Route::get('/frontend/delete-session', function() {
    session()->forget('cart');
    return redirect('frontend/home');
});

Route::get('/frontend/cart', [CartController::class, 'cartIndex']);

//mail
Route::get('/test', [MailController::class, 'index']);
Route::post('/frontend/sendmail/order/ajax', [MailController::class, 'sendMailOrder']);

//checkout
Route::get('/frontend/checkout', [CheckoutController::class, 'checkout']);
//đăng ký nhanh trong checkout
Route::post('/frontend/checkout', [CheckoutController::class, 'register']);

//search
Route::get('/frontend/shop/search', [SearchController::class, 'indexSearch']);
Route::get('/frontend/shop/search-advanced', [SearchAdvancedController::class, 'indexSearchAdvance']);
Route::post('/frontend/shop/search-advanced', [SearchAdvancedController::class, 'search']);
Route::post('/frontend/shop/search-price', [SearchPriceController::class, 'indexSearchPrice']);
