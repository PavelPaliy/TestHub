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

Route::get('/', 'MainController@main');

Auth::routes();
Route::get('/dashboard', 'UserController@index')->name('dashboard');

Route::get('/home', 'HomeController@index')->name('home');

/*Route::prefix('teacher')->group(function (){
    Route::get('/register', 'Auth\RegisterTeacherController@showRegistrationForm')->name('teacher.registerForm');
    Route::post('/register', 'Auth\RegisterTeacherController@register')->name('teacher.register');
    Route::get('/login', 'Auth\LoginTeacherController@showLoginForm')->name('teacher.loginForm');
    Route::post('/login', 'Auth\LoginTeacherController@login')->name('teacher.login');
    Route::get('/dashboard', 'TeacherController@index')->name('teacher.dashboard');
});*/
Route::get('/stat/results', 'UserController@results')->name('results');
Route::name('test.')->group(function () {
    Route::get('/new', 'TestController@create')->name('create');
    Route::post('/store', 'TestController@store')->name('store');
    Route::get('/publish/{id}', 'TestController@publish')->name('publish');
    Route::get('/test/{id}', 'TestController@show')->name('show');
    Route::get('/tags/{word}', 'TestController@tags')->name('tags');
    Route::match(['get', 'post'], '/test/{id}/question', 'TestController@questions')->name('pass');
    Route::get('/test/{id}/result', 'TestController@result')->name('result');
    Route::post('/test/mail', 'TestController@email')->name('email');

});
