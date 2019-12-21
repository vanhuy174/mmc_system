<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMmcEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mmc_employees', function (Blueprint $table) {

            $table->bigIncrements('id');

            $table->string('mmc_name'); //Họ và tên
            $table->string('mmc_employeeid')->unique(); //Mã giảng viên
            $table->string('mmc_deptid')->nullable();  //Mã bộ môn
            $table->string('mmc_avatar')->nullable(); //Ảnh đại diện
            $table->date('mmc_dateofbirth')->nullable(); //Ngày tháng và năm sinh
            $table->tinyInteger('mmc_gender')->nullable(); //Giới tính
            $table->string('mmc_personalid')->nullable(); //Số chứng minh nhân dân
            $table->date('mmc_dateofpid')->nullable(); //Ngày cấp
            $table->string('mmc_socialinsuranceid')->nullable(); //Số bảo hiểm xã hội


            $table->string('mmc_phone',12)->nullable(); //Số điện thoại
            $table->string('email')->unique(); //Email
            $table->string('password'); //Password
            $table->string('mmc_religion')->nullable(); //Dân tộc
            $table->string('mmc_ethnic')->nullable(); //Tôn giáo
            $table->string('mmc_placeofbirth')->nullable(); //Nơi Sinh
            $table->string('mmc_hometown')->nullable(); //Quê quán
            $table->string('mmc_address')->nullable(); //Hộ khẩu thường trú

            $table->date('mmc_dateofrecruit')->nullable(); //Ngày tuyển dụng

            $table->string('mmc_position')->nullable(); //Chức vụ hiện tại
            $table->string('mmc_maintask')->nullable(); //Công việc chính được giao

            $table->string('mmc_nameofjob')->nullable(); //Ngạch công chức
            $table->string('mmc_codeofjob')->nullable(); //Mã ngạch
            $table->float('mmc_salarylevel')->nullable(); //Bậc lương
            $table->float('mmc_salaryratio')->nullable(); //Hệ số

            $table->float('mmc_salaryposition')->nullable(); //Phụ cấp chức vụ
            $table->float('mmc_salaryother')->nullable(); //Phụ cấp khác

            $table->string('mmc_degree')->nullable(); //Trình độ chuyên môn cao nhất
            $table->string('mmc_language')->nullable(); //Ngoại ngữ
            $table->string('mmc_itlevel')->nullable(); //Tin học

            $table->string('mmc_politiclevel')->nullable(); //Lý luận chính trị
            $table->string('mmc_managementlevel')->nullable(); //Quản lý nhà nước


            $table->date('mmc_partydate')->nullable(); //Ngày vào Đảng Cộng sản Việt Nam
            $table->date('mmc_partydateprimary')->nullable(); //Ngày chính thức

            $table->string('mmc_reward')->nullable(); //Khen thưởng
            $table->string('mmc_discipline')->nullable(); //Kỷ luật

            $table->string('mmc_heathlevel')->nullable(); //Tình trạng sức khoẻ
            $table->string('mmc_bloodgroup')->nullable(); //Nhóm máu

            $table->float('mmc_tall')->nullable(); //Chiều cao
            $table->float('mmc_weight')->nullable(); //Cân nặng

            $table->softDeletes();
            $table->string('mmc_level')->nullable();
            $table->timestamp('email_verified_at')->nullable();

            $table->foreign('mmc_deptid')
                ->references('mmc_deptid')->on('mmc_departments')
                ->onDelete('cascade');

            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mmc_employees');
    }
}
