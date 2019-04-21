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
    return view('welcome');
});

Auth::routes();

Route::group(['prefix' => 'dashboard', 'middleware' => ['auth']], function () {
    Route::get('/', 'DashboardController@index')->name('dashboard');

    Route::group(['prefix' => 'student', 'middleware' => ['student']], function () {
        Route::get('/', 'StudentController@index')->name('student.index');
        Route::get('/edit', 'StudentController@edit')->name('student.edit');
        Route::put('/edit', 'StudentController@update')->name('student.update');
    });
    // Route::resource('student', 'StudentController')->middleware('student');
    Route::resource('teacher', 'TeacherController');
    
});
