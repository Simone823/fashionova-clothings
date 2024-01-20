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

// Auth
Auth::routes(['verify' => true]);

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

// Auth group
Route::middleware('auth')->group(function() {

    // User
    Route::middleware('roleUser')->prefix('user')->name('user.')->namespace('User')->group(function() {
        // Dashboard
        Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

        // Profile
        Route::get('/profiles/show/{id}', 'ProfileController@show')->name('profiles.show');
        Route::get('/profiles/edit/{id}', 'ProfileController@edit')->name('profiles.edit');
        Route::post('/profiles/update/{id}', 'ProfileController@update')->name('profiles.update');
        Route::post('/profiles/change-password/{id}', 'ProfileController@changePassword')->name('profiles.changePassword');
        Route::post('/profiles/create-address/{id}', 'ProfileController@createAddress')->name('profiles.createAddress');
        Route::delete('/profiles/delete/{id}', 'ProfileController@destroy')->name('profiles.delete');
        Route::delete('/profiles/delete-address/{id}/{userId}', 'ProfileController@deleteAddress')->name('profiles.deleteAddress');
    });

});