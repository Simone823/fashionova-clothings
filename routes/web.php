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

    // Admin
    Route::middleware('roleAdmin')->prefix('admin')->name('admin.')->namespace('Admin')->group(function() {
        // Admin Tools
        Route::get('/admin-tools/cache-clear-all', 'AdminToolController@cacheClearAll')->name('adminTools.cacheClearAll');

        // Details Company
        Route::get('/details-company/show', 'DetailCompanyController@show')->name('detailsCompany.show');
        Route::get('/details-company/edit', 'DetailCompanyController@edit')->name('detailsCompany.edit');
        Route::post('/details-company/update', 'DetailCompanyController@update')->name('detailsCompany.update');

        // Dashboard
        Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

        // Profile
        Route::get('/profiles/show/{id}', 'ProfileController@show')->name('profiles.show');
        Route::get('/profiles/edit/{id}', 'ProfileController@edit')->name('profiles.edit');
        Route::post('/profiles/update/{id}', 'ProfileController@update')->name('profiles.update');
        Route::post('/profiles/change-password/{id}', 'ProfileController@changePassword')->name('profiles.changePassword');

        // Permissions
        Route::get('/permissions/index', 'PermissionController@index')->name('permissions.index');
        Route::get('/permissions/create', 'PermissionController@create')->name('permissions.create');
        Route::post('/permissions/store', 'PermissionController@store')->name('permissions.store');
        Route::get('/permissions/edit/{id}', 'PermissionController@edit')->name('permissions.edit');
        Route::post('/permissions/update/{id}', 'PermissionController@update')->name('permissions.update');
        Route::delete('/permissions/delete/{id}', 'PermissionController@destroy')->name('permissions.delete');

        // Roles
        Route::get('/roles/index', 'RoleController@index')->name('roles.index');
        Route::get('/roles/create', 'RoleController@create')->name('roles.create');
        Route::post('/roles/store', 'RoleController@store')->name('roles.store');
        Route::get('/roles/edit/{id}', 'RoleController@edit')->name('roles.edit');
        Route::post('/roles/update/{id}', 'RoleController@update')->name('roles.update');
        Route::delete('/roles/delete/{id}', 'RoleController@destroy')->name('roles.delete');

        // Users
        Route::get('/users/index', 'UserController@index')->name('users.index');
        Route::get('/users/create', 'UserController@create')->name('users.create');
        Route::post('/users/store', 'UserController@store')->name('users.store');
        Route::get('/users/show/{id}', 'UserController@show')->name('users.show');
        Route::get('/users/edit/{id}', 'UserController@edit')->name('users.edit');
        Route::post('/users/update/{id}', 'UserController@update')->name('users.update');
        Route::delete('/users/delete/{id}', 'UserController@destroy')->name('users.delete');

        // Contacts
        Route::get('/contacts/index', 'ContactController@index')->name('contacts.index');
        Route::get('/contacts/show/{id}', 'ContactController@show')->name('contacts.show');
        Route::delete('/contacts/delete/{id}', 'ContactController@destroy')->name('contacts.delete');

        // User Addresses
        Route::get('/user-addresses/index', 'UserAddressController@index')->name('userAddresses.index');
        Route::get('/user-addresses/show/{id}', 'UserAddressController@show')->name('userAddresses.show');
    });
});