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

Route::get('/', function () {
    return redirect('login');
});
// Route::get('home', function () {
//         return view('admin.index');
//     });

Route::group(['prefix'=>'admin','middleware'=>'auth'],function(){
    // Route::get('home', function () {
    //     return view('admin.index');
    // });
    Route::get('/', function () {
        return view('admin.index');
    })->name('home');
    Route::post('class/import/', 'Admin\ClassController@import');
    Route::get('class/export/', 'Admin\ClassController@export');
    Route::resource('class', 'Admin\ClassController');
    Route::resource('major', 'Admin\MajorController');
    Route::resource('department', 'Admin\DepartmentController');
    Route::resource('schedule', 'Admin\ScheduleController');
    Route::resource('oneclass', 'Admin\OneClassController');

    Route::get('/homeStudent', 'Admin\mmc_ControllerStudent@index')->name('homeStudent');
    Route::get('/createstudent', 'Admin\mmc_ControllerStudent@getclass')->name('formcreateStudent');
    Route::post('/createstudent', 'Admin\mmc_ControllerStudent@create')->name('createStudent');
    Route::get('/destroyStudent/{id}', 'Admin\mmc_ControllerStudent@destroy')->name('destroyStudent');
    Route::get('/showStudent/{id}', 'Admin\mmc_ControllerStudent@show')->name('showStudent');
    Route::get('/editStudent/{id}', 'Admin\mmc_ControllerStudent@edit')->name('editStudent');
    Route::post('/updateStudent/{id}', 'Admin\mmc_ControllerStudent@update')->name('updateStudent');
    Route::post('/importStudent', 'Admin\mmc_ControllerStudent@import')->name('importStudent');
    Route::get('/downloadfileExcel', 'Admin\mmc_ControllerStudent@downloadfileExcel')->name('downloadfileExcel');
    Route::get('/exportStudent', 'Admin\mmc_ControllerStudent@export')->name('exportStudent');

});

