<?php

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

Route::get('/', function () {
    return view('acceuil');
});

Route::resource('utilisateurs', 'UtilisateurController');
Route::resource('communautes', 'CommunauteController');


// Show Register Page & Login Page
Route::get('/login', 'LoginController@show')->name('login')->middleware('guest');
Route::get('/register', 'RegistrationController@show')
    ->name('register')
    ->middleware('guest');


// Register & Login User
Route::post('/login', 'LoginController@authenticate');
Route::post('/register', 'RegistrationController@register');


// Protected Routes - allows only logged in users
Route::middleware('auth')->group(function () {
    Route::get('/', 'DashboardController@index');

    Route::post('/logout', 'LoginController@logout');
});
