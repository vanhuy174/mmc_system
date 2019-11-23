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

    // giảng viên
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

