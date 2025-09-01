<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;

use App\Http\Controllers\Backend\ProductsCategoryController;
use App\Http\Controllers\Backend\ProductsController;
use App\Http\Controllers\Backend\CategoryDetailsController;
use App\Http\Controllers\Backend\ProductDetailsController;
use App\Http\Controllers\Backend\HomeBannerDetailsController;
use App\Http\Controllers\Backend\HomeIntroDetailsController;
use App\Http\Controllers\Backend\HomeSocialDetailsController;
use App\Http\Controllers\Backend\HomeVisionController;
use App\Http\Controllers\Backend\AboutController;
use App\Http\Controllers\Backend\PrivacyController;
use App\Http\Controllers\Backend\TermsController;
use App\Http\Controllers\Backend\ContactController;
use App\Http\Controllers\Backend\DoctorPartnerController;
use App\Http\Controllers\Backend\ChemistPartnerController;
use App\Http\Controllers\Backend\DistributorPartnerController;


use App\Http\Controllers\Frontend\HomeController;;

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

// ==== Manage Home Intro Details
Route::resource('manage-intro-details', HomeIntroDetailsController::class);

// ==== Manage Home social Details
Route::resource('manage-social-home', HomeSocialDetailsController::class);

// ==== Manage Home Vision Details
Route::resource('manage-vision', HomeVisionController::class);

// ==== Manage About Us
Route::resource('manage-about-us', AboutController::class);

// ==== Manage Privacy Policy
Route::resource('manage-privacy-policy', PrivacyController::class);

// ==== Manage Privacy Policy
Route::resource('manage-terms-condition', TermsController::class);

// ==== Manage COntact Details
Route::resource('manage-contact-details', ContactController::class);

// ==== Manage Doctor Partner
Route::resource('manage-doctor-partner', DoctorPartnerController::class);

// ==== Manage Chemist Partner
Route::resource('manage-chemist-partner', ChemistPartnerController::class);

// ==== Manage Distributor Partner
Route::resource('manage-distributor-partner', DistributorPartnerController::class);








// ======================= Frontend

Route::group(['prefix'=> '', 'middleware'=>[\App\Http\Middleware\PreventBackHistoryMiddleware::class]],function(){

    // ==== Home
    Route::get('/', [HomeController::class, 'home'])->name('frontend.index');

    // ==== About us
    Route::get('/about-us', [HomeController::class, 'about_us'])->name('frontend.about_us');

    // ==== All Products List
    Route::get('/product-list', [HomeController::class, 'product_list'])->name('frontend.product_list');

    // ==== All Terms & Condition
    Route::get('/terms-and-conditions', [HomeController::class, 'terms_condition'])->name('frontend.terms_condition');

    // ==== All Privacy Policy
    Route::get('/privacy-policy', [HomeController::class, 'privacy_policy'])->name('frontend.privacy_policy');

    // ==== Contact Us
    Route::get('/contact-us', [HomeController::class, 'contact_us'])->name('frontend.contact_us');

     // ==== I am a Doctor
    Route::get('/i-am-a-doctor', [HomeController::class, 'i_am_doctor'])->name('frontend.i_am_doctor');

    // ==== I am a Chemist
    Route::get('/i-am-a-chemist', [HomeController::class, 'i_am_chemist'])->name('frontend.i_am_chemist');

    // ==== I am a Distributor
    Route::get('/i-am-a-distributor', [HomeController::class, 'i_am_distributor'])->name('frontend.i_am_distributor');

    // ==== Category Details
    Route::get('/category-details/{slug}', [HomeController::class, 'category_details'])->name('frontend.category_details');

    // Product details page
    Route::get('/product-details/{slug}', [HomeController::class, 'product_details'])->name('frontend.product_details');

});
