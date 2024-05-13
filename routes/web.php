<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\PlacesComponent;

Route::get('/', 'App\Http\Controllers\Auth\RegistrationController@showRegistrationForm')->name('register');
Route::post('/register', 'App\Http\Controllers\Auth\RegistrationController@register')->name('register.submit');

Route::get('/login', 'App\Http\Controllers\Auth\RegistrationController@showLoginForm')->name('login');
Route::post('/login', 'App\Http\Controllers\Auth\RegistrationController@login')->name('login.submit');

Route::get('/logout', 'App\Http\Controllers\Auth\RegistrationController@logout')->name('logout');

Route::get('/profile', 'App\Http\Controllers\Auth\RegistrationController@showProfileForm')->name('profile');

Route::post('/profile', 'App\Http\Controllers\Auth\RegistrationController@updateProfile')->name('profile.update');

Route::get('/home','App\Http\Controllers\home\HomeController@homePage')->middleware('auth')->name('home');
Route::get('/home/{dayId}','App\Http\Controllers\home\HomeController@homePage')->middleware('auth')->name('home.showDays');

Route::post('/reservation','App\Http\Controllers\home\HomeController@reservationPage')->middleware('auth')->name('home.reservation');

//Route::post('/rese','App\Http\Controllers\home\HomeController@cancelReservation')->middleware('auth')->name('home.cancelReservation');

Route::get('/send','App\Http\Controllers\home\HomeController@sendEmail');
