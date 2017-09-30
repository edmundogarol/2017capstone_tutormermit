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

Route::get('/select', function () {
    return view('selectskill');
});

Route::get('/edit','UserController@getEdit');

Route::get('/preferences','UserController@preferences');

Route::post('/select', function () {	
    return view('selectskill');
});
Route::get('/request', function () {
    return view('request');
});
// Route::get('/rereq', function () {
// 	return view('re-request');
// });

Route::get('/tutorde', function () {
	return view('tutor-detial');
});

Route::get('req/{id}','RequestsController@req');

Route::get('rereq/{id}','RequestsController@rereq');

Route::get('accept/{id}','RequestsController@accept');

Route::get('cancel/{id}','RequestsController@cancel');

Route::get('decline/{id}','RequestsController@decline');

Route::post('/rereq','RequestsController@store');

// Route::post('/preferences','UserController@update');

Route::post('/edit','UserController@update');

Route::post('/edit/subject/add', 'UserController@addSubject');

Route::post('/edit/subject/delete', 'UserController@deleteSubject');

Route::get('/home', 'HomeController@index');

Route::get('/tutor','HomeController@tutorView');

Route::get('/studentview','HomeController@studentView')->name('studentview');

