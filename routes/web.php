<?php

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/admin', function () {
    return view('admin');
})->name('admin');

Route::post('pacckage_create_form', function () {
    return "okey";
})->name('pacckage_create_form');
