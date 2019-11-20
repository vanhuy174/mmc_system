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
    return view('admin.class.index');
})->name('home');

Route::get('/homeStudent', 'mmc_ControllerStudent@index')->name('homeStudent');
Route::get('/createstudent', 'mmc_ControllerStudent@getclass')->name('formcreateStudent');
Route::post('/createstudent', 'mmc_ControllerStudent@create')->name('createStudent');
Route::get('/destroyStudent/{id}', 'mmc_ControllerStudent@destroy')->name('destroyStudent');
Route::get('/showStudent/{id}', 'mmc_ControllerStudent@show')->name('showStudent');
Route::get('/editStudent/{id}', 'mmc_ControllerStudent@edit')->name('editStudent');
Route::post('/updateStudent/{id}', 'mmc_ControllerStudent@update')->name('updateStudent');
Route::post('/importStudent', 'mmc_ControllerStudent@import')->name('importStudent');
Route::get('/downloadfileExcel', 'mmc_ControllerStudent@downloadfileExcel')->name('downloadfileExcel');
Route::get('/exportStudent', 'mmc_ControllerStudent@export')->name('exportStudent');
