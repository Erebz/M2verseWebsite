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

Route::get('/info', function () {
    return view('info');
});


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
    Route::get('/', 'HomeController@index')->name('home');
    Route::get('/home', 'HomeController@index')->name('home');

    Route::resource('utilisateurs', 'UtilisateurController');
    Route::resource('communautes', 'CommunauteController');

    //Community features
    Route::post('/communautes/{com}/join', 'CommunauteController@joinCom')->name('communaute.join');
    Route::post('/communautes/{com}/leave', 'CommunauteController@leaveCom')->name('communaute.leave');
    Route::post('/communautes/{com}/post', 'PublicationController@store')->name('communaute.publish');

    //Publication & comments features
    //->Like/dislike
    Route::get('/publications/{publication}', 'PublicationController@show')->name('publication.show');
    Route::post('/publications/{publication}/like', 'PublicationController@like')->name('publication.like');
    Route::delete('/publications/{publication}/like', 'PublicationController@dislike')->name('publication.dislike');
    Route::post('/comments/{comment}/like', 'MessageController@like')->name('comment.like');
    Route::delete('/comments/{comment}/like', 'MessageController@dislike')->name('comment.dislike');
    //->Comment
    Route::post('/publications/{publication}/comment', 'MessageController@store')->name('publication.comment');
    //->Delete
    Route::delete('/publications/{publication}/delete', 'PublicationController@destroy')->name('publication.delete');
    Route::delete('/comments/{comment}/delete', 'MessageController@destroy')->name('comment.delete');


    Route::post('/logout', 'LoginController@logout')->name('logout');
});
