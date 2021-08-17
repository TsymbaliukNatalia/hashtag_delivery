<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


Route::get('/', function () {
    return view('welcome');
})->name('start');


Route::post('get_points', 'PackageController@getCityPoints')->name('get_points');
Route::post('calculate_package_cost', 'PackageController@getPackageCost')->name('calculate_package_cost');
Route::get('/points', 'PackageController@getCity')->name('points');
Route::get('/calculate', 'PackageController@getPackageCalculateInfo')->name('calculate');
Route::post('get_package_info_number', 'PackageController@getInfoPackageByNumber')->name('get_package_info_number');

Auth::routes();


Route::group(['prefix' => 'admin'], function () {
  Route::get('/login', 'AdminAuth\LoginController@showLoginForm')->name('login');
  Route::post('/login', 'AdminAuth\LoginController@login');
  Route::get('/logout', 'AdminAuth\LoginController@logout')->name('logout');

  Route::get('/register', 'AdminAuth\RegisterController@showRegistrationForm')->name('register');
  Route::post('/register', 'AdminAuth\RegisterController@register');

  Route::post('/password/email', 'AdminAuth\ForgotPasswordController@sendResetLinkEmail')->name('password.request');
  Route::post('/password/reset', 'AdminAuth\ResetPasswordController@reset')->name('password.email');
  Route::get('/password/reset', 'AdminAuth\ForgotPasswordController@showLinkRequestForm')->name('password.reset');
  Route::get('/password/reset/{token}', 'AdminAuth\ResetPasswordController@showResetForm');

  Route::get('/new_package', 'PackageController@getStartInfo')->name('new_package');
  Route::post('sender_info', 'PackageController@getSenderInfo')->name('sender_info');
  Route::post('recipient_info', 'PackageController@getRecipientInfo')->name('recipient_info');
  Route::post('add_new_package', 'PackageController@addNewPackage')->name('add_new_package');
  Route::post('get_points', 'PackageController@getCityPoints')->name('get_points');
  Route::post('calculate_package_cost', 'PackageController@getPackageCost')->name('calculate_package_cost');
});

Route::group(['prefix' => 'vendor'], function () {
  Route::get('/login', 'VendorAuth\LoginController@showLoginForm')->name('login');
  Route::post('/login', 'VendorAuth\LoginController@login');
  Route::get('/logout', 'VendorAuth\LoginController@logout')->name('logout');

  Route::get('/register', 'VendorAuth\RegisterController@showRegistrationForm')->name('register');
  Route::post('register', 'VendorAuth\RegisterController@register');

  Route::post('/password/email', 'VendorAuth\ForgotPasswordController@sendResetLinkEmail')->name('password.request');
  Route::post('/password/reset', 'VendorAuth\ResetPasswordController@reset')->name('password.email');
  Route::get('/password/reset', 'VendorAuth\ForgotPasswordController@showLinkRequestForm')->name('password.reset');
  Route::get('/password/reset/{token}', 'VendorAuth\ResetPasswordController@showResetForm');
  Route::post('get_packages_for_user', 'PackageController@getUserPackages')->name('get_packages_for_user');
  Route::post('get_packages_count', 'PackageController@getPackagesCount')->name('get_packages_count');
  Route::post('user_info', 'ClientController@getClientStartInfo')->name('user_info');
  Route::post('get_points', 'PackageController@getCityPoints')->name('get_points');

});
