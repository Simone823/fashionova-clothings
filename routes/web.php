<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Guest
Route::namespace('Guest')->group(function() {
    // Default
    Route::get('/', 'HomeController@index')->name('guest.home');

    // Contact Us
    Route::get('/contact-us', 'ContactUsController@index')->name('guest.contactUs');
    Route::post('/contact-us/store', 'ContactUsController@store')->name('guest.contactUs.store');

    // Cart Shop
    Route::get('/cart-shop', 'CartShopController@index')->name('guest.cartShop');
});