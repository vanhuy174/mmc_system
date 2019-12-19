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
    Route::group(['middleware'=>'role'],function() {
        Route::post('subject/import/', 'Admin\SubjectController@import');
        Route::post('class/import/', 'Admin\ClassController@import');
        Route::get('class/export/', 'Admin\ClassController@export');
        Route::resource('subject', 'Admin\SubjectController');
        Route::resource('class', 'Admin\ClassController');
        Route::resource('major', 'Admin\MajorController');
        Route::resource('educationprogram', 'Admin\EducationProgramController');
        Route::resource('department', 'Admin\DepartmentController');

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
<<<<<<< HEAD
        Route::post('/ajaxmajor', 'Admin\mmc_ControllerStudent@ajaxmajor')->name('ajaxmajor');
        Route::post('setstatus', 'Admin\mmc_ControllerStudent@setstatus')->name('setstatus');
=======
        Route::post('/statusstudent', 'Admin\mmc_ControllerStudent@statusstudent')->name('statusstudent');
        Route::post('/withclass', 'Admin\mmc_ControllerStudent@withclass')->name('withclass');
>>>>>>> ca394d0ecc9e0d7888c08cfe92ac2984e09038f9

        //route lịch
        Route::get('/homeCalendar', 'Admin\calendarController@index')->name('homeCalendar');
        Route::post('/importCalendar', 'Admin\calendarController@store')->name('importCalendar');
        Route::post('/edittime', 'Admin\ScheduleController@store')->name('edittime');

        //route giảng viên
        Route::group(['prefix' => '/giang-vien'], function () {
            // danh sách giảng viên: /admin/giang-vien/danh-sach-giang-vien
            Route::get('/danh-sach-giang-vien',[
                'as'=>'danh-sach-giang-vien',
                'uses'=>'GiangVienController@getDanhSachGV'
            ]);
            // thêm giảng viên: /admin/giang-vien/them-giang-vien
            Route::get('/them-giang-vien',[
                'as'=>'get-them-giang-vien',
                'uses'=>'GiangVienController@getThemGV'
            ]);
            Route::post('/them-giang-vien',[
                'as'=>'post-them-giang-vien',
                'uses'=>'GiangVienController@postThemGV'
            ]);
            // sửa thông tin giảng viên: /admin/giang-vien/sua-thong-tin-giang-vien/{id}
            Route::get('/sua-thong-tin-giang-vien/{id}',[
                'as'=>'get-sua-thong-tin-giang-vien',
                'uses'=>'GiangVienController@getSuaGV'
            ]);
            Route::post('/sua-thong-tin-giang-vien/{id}',[
                'as'=>'post-sua-thong-tin-giang-vien',
                'uses'=>'GiangVienController@postSuaGV'
            ]);
            // thông tin giảng viên: /admin/giang-vien/thong-tin-giang-vien/{id}
            Route::get('/thong-tin-giang-vien/{id}',[
                'as'=>'get-thong-tin-giang-vien',
                'uses'=>'GiangVienController@getThongTinGV'
            ]);
            // tìm kiếm giảng viên: /admin/giang-vien/tim-kiem-thong-tin-giang-vien/{id}
            Route::post('/tim-kiem-thong-tin-giang-vien',[
                'as'=>'get-tim-kiem-giang-vien',
                'uses'=>'GiangVienController@postTimKiemGV'
            ]);
            // xóa giảng viên: /admin/giang-vien/xoa-giang-vien/{id}
            Route::get('/xoa-giang-vien/{id}',[
                'as'=>'get-xoa-giang-vien',
                'uses'=>'GiangVienController@getXoaGV'
            ]);

            // cá nhân: /admin/giang-vien/thong-tin-ca-nhan
            Route::get('/thong-tin-ca-nhan/{id}',[
                'as'=>'get-thong-tin-ca-nhan',
                'uses'=>'GiangVienController@getThongTinCN'
            ]);
            // sửa cá nhân: /admin/giang-vien/sua-thong-tin-ca-nhan
            Route::get('/sua-thong-tin-ca-nhan/{id}',[
                'as'=>'get-sua-thong-tin-ca-nhan',
                'uses'=>'GiangVienController@getSuaCN'
            ]);
            Route::post('/sua-thong-tin-ca-nhan/{id}',[
                'as'=>'post-sua-thong-tin-ca-nhan',
                'uses'=>'GiangVienController@postSuaCN'
            ]);
            // đổi passwword: /admin/giang-vien/doi-password
            Route::get('/doi-password/{id}',[
                'as'=>'get-doi-pass',
                'uses'=>'GiangVienController@getDoiPass'
            ]);
            Route::post('/doi-password/{id}',[
                'as'=>'post-doi-pass',
                'uses'=>'GiangVienController@postDoiPass'
            ]);
        });
    });
    Route::resource('schedule', 'Admin\ScheduleController');
    Route::resource('oneclass', 'Admin\OneClassController');
    Route::resource('subjectclass', 'Admin\subjectclassController');

    //Route điểm sinh viên.

    Route::get('/studentpoint', 'Admin\studentpointController@index')->name('studentpoint');
    Route::get('/studentpoint/{id}', 'Admin\studentpointController@getclass')->name('getstudentpoint');
    Route::post('/addinfor', 'Admin\studentpointController@infoStudent')->name('infoStudent');
    Route::post('/addpoint', 'Admin\studentpointController@pointstudent')->name('pointstudent');
    Route::post('/addpointtest', 'Admin\studentpointController@pointtest')->name('pointtest');
    Route::post('/ratio', 'Admin\studentpointController@editratio')->name('editratio');
//     Route::get('/subjectclass', 'Admin\studentpointController@infoStudent')->name('infoStudent');
//     Route::get('/subjectclass', 'Admin\studentpointController@infoStudent')->name('infoStudent');
});

