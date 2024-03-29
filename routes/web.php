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
    Route::get('/login', 'AuthController@getLogin')->name('login');
    route::post('/login', 'AuthController@login')->name('admin.login');
});

Route::group(['namespace' => 'Admin','middleware' => 'auth'], function () {
    route::post('/logout', 'AuthController@logout')->name('admin.logout');
    Route::get('/', 'AuthController@viewDashboard')->name('view.dashboard');

    route::post('/update-banners', 'BannerController@store')->name('save.banners');
    route::delete('/delete-banner', 'BannerController@destroyBanner')->name('delete.banner');

    route::post('/update-token-device', 'AuthController@updateDevice')->name('update.token.device');


    Route::group(['prefix' => 'teacher'], function () {
        route::get('/teachers', 'TeacherController@index')->name('manage.teacher');
        route::get('/datatable-teacher', 'TeacherController@datatable')->name('datatable.teacher');
        route::get('/create-teacher', 'TeacherController@viewAdd')->name('view.add.teacher');
        route::post('/create-teacher', 'TeacherController@createTeacher')->name('add.teacher');
        route::get('/edit-teacher/{id}', 'TeacherController@getEdit')->name('view.edit.teacher');
        route::post('/edit-teacher', 'TeacherController@updateTeacher')->name('edit.teacher');
        Route::delete('/delete-teacher', 'TeacherController@deleteTeacher')->name('delete.teacher');
    });

    Route::group(['prefix' => 'exersire'], function () {
        route::get('/', 'ExersireController@index')->name('index.exersire');
        route::get('/datatable-exercire', 'ExersireController@datatable')->name('datatable.exercire');
        route::get('/add-exersire', 'ExersireController@addExersire')->name('view.add.exersire');
        route::post('/add-exersire', 'ExersireController@createNewEx')->name('add.exersire');
        route::get('update-exersire/{id}', 'ExersireController@getUpdateEx')->name('view.update.ex');
        route::post('update-exersire', 'ExersireController@updateExer')->name('update.exer');

        Route::post('/upload-image', 'ExersireController@uploadImage')->name('upload.chipboash');
        Route::delete('/delete-exercire/{id}', 'ExersireController@deleteEx')->name('delete.exercire');

        route::get('{id}/comments', 'ExersireController@viewCommnets')->name('view.comment.exersire');
        route::get('comment-exer', 'ExersireController@comment')->name('comment.exersire');

    });

    Route::group(['prefix' => 'student'], function () {
        route::get('/', 'StudentController@index')->name('index.student');
        route::get('/datatable-teacher', 'StudentController@datatable')->name('datatable.student');
        route::get('/student-detail/{id}', 'StudentController@detail')->name('student.detail');
        route::post('/active-student', 'StudentController@activeStudent')->name('active.student');
    });

    Route::group(['prefix' => 'test'], function () {
        route::get('/','TestController@index')->name('index.test');
        route::get('/datatable-test', 'TestController@datatable')->name('get.data.table.test');
        route::get('/add-test', 'TestController@addTestOnline')->name('view.add.test');
        route::post('/add-test', 'TestController@createTest')->name('add.test');
        route::get('/answer/{id}','TestController@viewTestAnswers')->name('answer.test');
        route::post('/update-test', 'TestController@updateTest')->name('update.test');
        route::get('/update-answer', 'TestController@updateAnswer')->name('update.answer.test');
        route::post('/upload-answer', 'TestController@uploadImgAns')->name('upload.image.ans');
        route::get('/save-image-answer', 'TestController@saveImageAnswer')->name('save.image.test');

        route::delete('/delete-test', 'TestController@deleteTest')->name('delete.test');

        route::get('report-test/{id}', 'TestController@reportTest')->name('report.test');
    });

    Route::group(['prefix' => 'type-class'], function () {
        route::get('/', 'TestTypeController@index')->name('index.test.type');
        route::get('/add', 'TestTypeController@add')->name('view.add.test.type');
        route::post('/store', 'TestTypeController@store')->name('store.test.type');
        route::get('edit/{id}', 'TestTypeController@edit')->name('view.edit.test.type');
        route::post('/update', 'TestTypeController@update')->name('update.test.type');
        route::get('/select-test-type', 'TestTypeController@getTestType')->name('get.test.type');
    });

    Route::group(['prefix' => 'exersire-type'], function () {
        route::get('/exersire-type', 'ExerciseTypeController@index')->name('index.exersire.type');
        route::get('/datatable-type-exersire', 'ExerciseTypeController@datatable')->name('datatable.exersire.type');
        route::get('/create-ex-type', 'ExerciseTypeController@viewAdd')->name('view.add.type');
        route::post('/create-ex-type', 'ExerciseTypeController@createType')->name('add.type');
        route::get('/edit-ex-type/{id}', 'ExerciseTypeController@viewEdit')->name('view.edit.type');
        route::post('/edit-ex-type', 'ExerciseTypeController@updateType')->name('edit.type');
    });

    Route::group(['prefix' => 'chu-de'], function () {
        route::get('/', 'ThemesController@index')->name('index.themes');
        route::get('/datatable-themes', 'ThemesController@datatable')->name('datatable.themes');
        route::get('/create-themes', 'ThemesController@viewAdd')->name('view.add.themes');
        route::post('/create-themes', 'ThemesController@createThemes')->name('add.themes');
        route::get('/edit-themes/{id}', 'ThemesController@viewEdit')->name('view.edit.themes');
        route::post('/edit-themes', 'ThemesController@updateThemes')->name('edit.themes');
    });

    Route::group(['prefix' => 'thong-bao'], function () {
        route::get('/', 'NotificationController@index')->name('index.notification');
    });

});
