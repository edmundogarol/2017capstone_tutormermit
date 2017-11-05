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

// REQUESTING MENTORING
Route::get('req/{id}/{match_perc}','RequestsController@req');

Route::get('rereq/{id}','RequestsController@rereq');

Route::get('accept/{id}','RequestsController@accept');

Route::get('cancel/{id}','RequestsController@cancel');

Route::get('decline/{id}','RequestsController@decline');

Route::post('/rereq','RequestsController@store');

// SESSIONS

Route::get('/mentor/end/session/{id}','MentorSessionController@mentorEnd');

Route::get('/student/end/session/{id}','MentorSessionController@studentEnd');

// EDINTING PREFERENCES AND PROFILE
Route::get('/edit','UserController@getEdit');

Route::post('/edit','UserController@update');

Route::post('/home/subject/add', 'UserController@addSubject');

Route::post('/home/subject/delete', 'UserController@deleteSubject');

Route::post('/edit/subject/add', 'UserController@addSubject');

Route::post('/edit/subject/delete', 'UserController@deleteSubject');

Route::get('/preferences','AcadController@preferences');

Route::post('/preferences','AcadController@update');

Route::post('/preferences/subject/add', 'AcadController@addSubject');

Route::post('/preferences/subject/delete', 'AcadController@deleteSubject');

// HOME ROUTES
Route::get('/home', 'HomeController@index');

Route::get('/tutor','HomeController@tutorView');

Route::get('/studentview','HomeController@studentView')->name('studentview');


// UNUSED
Route::get('/update', function () {
    return view('tempupdateprofile');
});

Route::get('/select', function () {
    return view('selectskill');
});

Route::post('/select', function () {	
    return view('selectskill');
});
Route::get('/request', function () {
    return view('request');
});

Route::get('/tutorde', function () {
	return view('tutor-detial');
});
Route::get('/rating', function () {
	return view('feedback');
});

