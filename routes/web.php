<?php

use Illuminate\Support\Facades\Route;

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

Route::group(['namespace' => 'Admin'], function () {
    Route::get('/login', 'AuthController@getLogin')->name('getLogin');
    route::post('/login', 'AuthController@login')->name('admin.login');
});

Route::group(['namespace' => 'Admin','middleware' => 'auth'], function () {
    route::post('/logout', 'AuthController@logout')->name('admin.logout');
    Route::get('/dashboard', 'AuthController@viewDashboard')->name('view.dashboard');

    Route::group(['prefix' => 'teacher'], function () {
        route::get('/teachers', 'TeacherController@index')->name('manage.teacher');
        route::get('/datatable-teacher', 'TeacherController@datatable')->name('datatable.teacher');
        route::get('/create-teacher', 'TeacherController@viewAdd')->name('view.add.teacher');
        route::post('/create-teacher', 'TeacherController@createTeacher')->name('add.teacher');
        route::get('/edit-teacher/{id}', 'TeacherController@getEdit')->name('view.edit.teacher');
        route::post('/edit-teacher', 'TeacherController@updateTeacher')->name('edit.teacher');
    });

    Route::group(['prefix' => 'exersire'], function () {
        route::get('/exersire-type', 'ExerciseTypeController@index')->name('index.exersire.type');
        route::get('/datatable-type-exersire', 'ExerciseTypeController@datatable')->name('datatable.exersire.type');
        route::get('/create-ex-type', 'ExerciseTypeController@viewAdd')->name('view.add.type');
        route::post('/create-ex-type', 'ExerciseTypeController@createType')->name('add.type');
        route::get('/edit-ex-type/{id}', 'ExerciseTypeController@viewEdit')->name('view.edit.type');
        route::post('/edit-ex-type', 'ExerciseTypeController@updateType')->name('edit.type');
    });

});
