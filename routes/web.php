<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;

use App\Http\Controllers\Backend\ProductsCategoryController;
use App\Http\Controllers\Backend\ProductsController;
use App\Http\Controllers\Backend\CategoryDetailsController;
use App\Http\Controllers\Backend\ProductDetailsController;
use App\Http\Controllers\Backend\HomeBannerDetailsController;








// =========================================================================== Backend Routes

// Route::get('/', function () {
//     return view('frontend.index');
// });
  
// Authentication Routes
Route::get('/login', [LoginController::class, 'login'])->name('admin.login');
Route::post('/login', [LoginController::class, 'authenticate'])->name('admin.authenticate');
Route::get('/logout', [LoginController::class, 'logout'])->name('admin.logout');
Route::get('/change-password', [LoginController::class, 'change_password'])->name('admin.changepassword');
Route::post('/update-password', [LoginController::class, 'updatePassword'])->name('admin.updatepassword');

Route::get('/register', [LoginController::class, 'register'])->name('admin.register');
Route::post('/register', [LoginController::class, 'authenticate_register'])->name('admin.register.authenticate');
    
// // Admin Routes with Middleware
Route::group(['middleware' => ['auth:web', \App\Http\Middleware\PreventBackHistoryMiddleware::class]], function () {
        Route::get('/dashboard', function () {
            return view('backend.dashboard'); 
        })->name('admin.dashboard');
});


// Route::group(['middleware' => ['auth:web', \App\Http\Middleware\PreventBackHistoryMiddleware::class]], function () {
//     Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('admin.dashboard');
// });


// ==== Manage Products Category
Route::resource('manage-products-category', ProductsCategoryController::class);

// ==== Manage Products
Route::resource('manage-products', ProductsController::class);

// ==== Manage Products
Route::resource('manage-category-details', CategoryDetailsController::class);

// ==== Manage Products Details
Route::resource('manage-product-details', ProductDetailsController::class);
Route::get('/get-products/{category}', [ProductDetailsController::class, 'getProducts']);

// ==== Manage Home Banner Details
Route::resource('manage-home-banner-details', HomeBannerDetailsController::class);

