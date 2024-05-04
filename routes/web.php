<?php

use Illuminate\Support\Facades\Route;



Route::get('/register', 'App\Http\Controllers\Auth\RegistrationController@showRegistrationForm')->name('register');
Route::post('/register', 'App\Http\Controllers\Auth\RegistrationController@register')->name('register.submit');

Route::get('/login', 'App\Http\Controllers\Auth\RegistrationController@showLoginForm')->name('login');
Route::post('/login', 'App\Http\Controllers\Auth\RegistrationController@login')->name('login.submit');

 Route::get('/home', function () {
     return view('welcome');
 })->middleware('auth');
