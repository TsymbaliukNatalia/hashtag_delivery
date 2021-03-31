<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


Route::get('/', function () {
    return view('welcome');
})->name('start');

Route::get('/admin', function () {
    return view('admin');
})->name('admin');

Route::get('/new_package', 'PackageController@getStartInfo')->name('new_package');

Route::post('sender_info', 'PackageController@getSenderInfo')->name('sender_info');
Route::post('recipient_info', 'PackageController@getRecipientInfo')->name('recipient_info');

Route::post('get_points', 'PackageController@getCityPoints')->name('get_points');

Route::post('calculate_package_cost', 'PackageController@getPackageCost')->name('calculate_package_cost');

Route::post('add_new_package', 'PackageController@addNewPackage')->name('add_new_package');

Route::get('/points', 'PackageController@getCity')->name('points');
Route::get('/calculate', 'PackageController@getPackageCalculateInfo')->name('calculate');

Route::post('get_package_info_number', 'PackageController@getInfoPackageByNumber')->name('get_package_info_number');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/admin', 'AdminController@index')->name('admin');

Route::get('/logout', 'Auth\LoginController@logout')->name('logout');

