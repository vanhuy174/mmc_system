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


Auth::routes();

Route::get('/', function (){
    return redirect('login');
});


Route::group(['prefix'=>'admin','middleware'=>'auth'],function(){
    Route::get('/', function () {
        return view('admin.index');
    });
    Route::post('class/import/', 'Admin\ClassController@import');
    Route::get('class/export/', 'Admin\ClassController@export');
    Route::resource('class', 'Admin\ClassController');
    Route::resource('major', 'Admin\MajorController');
    Route::resource('department', 'Admin\DepartmentController');
    Route::resource('schedule', 'Admin\ScheduleController');
    Route::resource('oneclass', 'Admin\OneClassController');

});
