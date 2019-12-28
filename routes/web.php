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
    return redirect()->route('login');
});
// Route::get('home', function () {
//         return view('admin.index');
//     });

Route::group(['prefix'=>'admin','middleware'=>'auth'],function(){
    // Route::get('home', function () {
    //     return view('admin.index');
    // });
    Route::get('/', 'Admin\homeController@index')->name('home');
    Route::group(['middleware'=>'role'],function() {
        Route::post('subject/import/', 'Admin\SubjectController@import');
        Route::post('class/import/', 'Admin\ClassController@import');
        Route::get('class/export/', 'Admin\ClassController@export');
        Route::resource('subject', 'Admin\SubjectController');
        Route::resource('class', 'Admin\ClassController');
        Route::resource('major', 'Admin\MajorController')->only([
            'index', 'create' , 'store'
        ]);
        Route::resource('educationprogram', 'Admin\EducationProgramController');
        Route::resource('department', 'Admin\DepartmentController')->only([
            'index', 'create' , 'store'
        ]);;

        //route sinh viên.
        Route::get('/homeStudent', 'Admin\mmc_ControllerStudent@index')->name('homeStudent');
        Route::get('/createstudent', 'Admin\mmc_ControllerStudent@getclass')->name('formcreateStudent');
        Route::post('/createstudent', 'Admin\mmc_ControllerStudent@create')->name('createStudent');
        Route::get('/delete/{id}', 'Admin\mmc_ControllerStudent@destroy')->name('destroyStudent');
        Route::get('/showStudent/{id}', 'Admin\mmc_ControllerStudent@show')->name('showStudent');
        Route::get('/editStudent/{id}', 'Admin\mmc_ControllerStudent@edit')->name('editStudent');
        Route::post('/updateStudent/{id}', 'Admin\mmc_ControllerStudent@update')->name('updateStudent');
        Route::post('/importStudent', 'Admin\mmc_ControllerStudent@import')->name('importStudent');
        Route::get('/downloadfileExcel', 'Admin\mmc_ControllerStudent@downloadfileExcel')->name('downloadfileExcel');
        Route::get('/exportStudent', 'Admin\mmc_ControllerStudent@export')->name('exportStudent');

        Route::post('/aajaxmajor', 'Admin\mmc_ControllerStudent@ajaxmajor')->name('aajaxmajor');
        Route::post('setstatus', 'Admin\mmc_ControllerStudent@setstatus')->name('setstatus');

//        Route::post('/statusstudent', 'Admin\mmc_ControllerStudent@statusstudent')->name('statusstudent');
//        Route::post('/withclass', 'Admin\mmc_ControllerStudent@withclass')->name('withclass');
        //export excel student point.
        Route::get('/exportPointstudent', 'Admin\studentpointController@export')->name('exportPointstudent');

        //route lịch
        Route::get('homeCalendar', 'Admin\calendarController@index')->name('homeCalendar');
        Route::post('importCalendar', 'Admin\calendarController@store')->name('importCalendar');
        Route::post('edittime', 'Admin\ScheduleController@store')->name('edittime');

        // danh sách giảng viên đã xóa
        Route::get('giangvien/xoagiangvien', 'Admin\GiangVienController@xoagv')->name('getXoa');
        Route::get('giangvien/xemthongtin/{id}', 'Admin\GiangVienController@xemthongtin')->name('getThongTin');
        Route::get('giangvien/phuchoi/{id}', 'Admin\GiangVienController@phuchoi')->name('getPhucHoi');

        //route giảng viên
        Route::resource('giangvien', 'Admin\GiangVienController');

        //route cá nhân
        Route::resource('canhan', 'Admin\CaNhanController');
        // đổi mật khẩu
        Route::get('canhan/matkhau/{id}','Admin\CaNhanController@getDoiPass')->name('getDoiPass');
        Route::post('canhan/matkhau/{id}','Admin\CaNhanController@postDoiPass')->name('postDoiPass');


    });
    Route::resource('schedule', 'Admin\ScheduleController');
    Route::resource('science', 'Admin\ScienceController');
    Route::post('updatecalendar','Admin\ScheduleController@updatecalendar')->name('updatecalendar');
    Route::resource('oneclass', 'Admin\OneClassController');
    Route::resource('subjectclass', 'Admin\subjectclassController');
    Route::resource('scienceemployee', 'Admin\ScienceEmployeeController');
    //Route điểm sinh viên.

    Route::get('/studentpoint', 'Admin\studentpointController@index')->name('studentpoint');
    Route::get('/studentpoint/{id}', 'Admin\studentpointController@getclass')->name('getstudentpoint');
    Route::post('/addinfor', 'Admin\studentpointController@infoStudent')->name('infoStudent');
    Route::post('/addpoint', 'Admin\studentpointController@pointstudent')->name('pointstudent');
    Route::post('/addpointtest', 'Admin\studentpointController@pointtest')->name('pointtest');
    Route::post('/ratio', 'Admin\studentpointController@editratio')->name('editratio');
//     Route::get('/subjectclass', 'Admin\studentpointController@infoStudent')->name('infoStudent');
//     Route::get('/subjectclass', 'Admin\studentpointController@infoStudent')->name('infoStudent');
    Route::post('ajax/education', 'Admin\AjaxController@getEducation')->name('ajax');
    Route::post('ajax/getmajor', 'Admin\AjaxController@getMajor')->name('ajaxgetmajor');
    Route::post('ajax/geteducation', 'Admin\AjaxController@getCTDT')->name('ajaxgeteducation');
    Route::post('ajax/getclass', 'Admin\AjaxController@getClass')->name('ajaxgetclass');
    Route::post('ajax/getmission', 'Admin\AjaxController@getMission')->name('ajaxmission');
    Route::post('ajax/getupdate', 'Admin\AjaxController@getUpdate')->name('ajaxupdate');
});

