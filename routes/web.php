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

// Auth::routes();

Route::get('/', function () {
    return view('welcomepublic');
});

 // Authentication Routes...
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

// Registration Routes...
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');

// Password Reset Routes...
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');

Route::get('/update', function () {
    return view('tempupdateprofile');
});

Route::get('/tutor', function () {
    return view('tutor');
});
Route::get('/select', function () {
    return view('selectskill');
});


Route::get('/edit', function () {
    return view('edit');
});

Route::post('/edit', function () {
    return view('edit');
});
Route::post('/select', function () {
    return view('selectskill');
});
Route::get('/req', function () {
    return view('request');
});

Route::get('/home', 'HomeController@index');

Route::get('/tutor','HomeController@tutor');
