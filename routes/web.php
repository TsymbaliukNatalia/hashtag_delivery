<?php

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/admin', 'PackageController@getStartInfo')->name('admin');

Route::post('sender_info', 'PackageController@getSenderInfo')->name('sender_info');
Route::post('recipient_info', 'PackageController@getRecipientInfo')->name('recipient_info');

Route::post('get_points', 'PackageController@getCityPoints')->name('get_points');

Route::post('calculate_package_cost', 'PackageController@getPackageCost')->name('calculate_package_cost');


