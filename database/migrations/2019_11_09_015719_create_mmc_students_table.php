<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMmcStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mmc_students', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('mmc_studentid')->unique(); //mã sinh viên
            $table->string('mmc_classid');  //mã lớp
            $table->string('mmc_fullname')->nullable(); //họ tên
            $table->date('mmc_dateofbirth')->nullable();    //ngày sinh
            $table->tinyInteger('mmc_gender')->nullable();  //giới tính
            $table->string('mmc_email')->nullable();    //email
            $table->string('mmc_phone')->nullable();    //số điện thoại
            $table->string('mmc_address')->nullable();  //địa chỉ
            $table->string('mmc_ethnic')->nullable();   //Dân tộc
            $table->string('mmc_religion')->nullable(); //Tôn giáo
            $table->string('mmc_reward')->nullable();   //Khen thưởng
            $table->string('mmc_descipline')->nullable();   //Kỷ luật
            $table->string('mmc_personalid')->unique();   //Số CMND
            $table->string('mmc_dormitory')->nullable();    //Dãy nhà ký túc xã
            $table->string('mmc_room_dormitory')->nullable();   //số phòng ký túc xã
            $table->string('mmc_landlord_name')->nullable();    //tên chủ xóm trọ
            $table->string('mmc_landlord_phone')->nullable();   //Số điện thoại chủ xóm trọ
            $table->string('mmc_landlord_address')->nullable();     //Địa chỉ chi tiết
            $table->string('mmc_status')->nullable();   //trạng thái sinh viên (đang học, đang bảo lưu, bị đuổi học, đã tốt ngiệp )
            $table->string('mmc_father')->nullable();   //Họ tên bố
            $table->string('mmc_fathernationality')->nullable();    //Quốc tịch
            $table->string('mmc_fatherethnic')->nullable();     //dân tôc
            $table->string('mmc_fatherreligion')->nullable();       //tôn giáo
            $table->string('mmc_fatheraddress')->nullable();    //địa chỉ
            $table->string('mmc_fatherphone')->nullable();  //số điện thoại
            $table->string('mmc_fatheremail')->nullable();      //email
            $table->string('mmc_fatherjob')->nullable();    //Nghề ngiệp
            $table->string('mmc_mother')->nullable();
            $table->string('mmc_mothernationality')->nullable();
            $table->string('mmc_motherethnic')->nullable();
            $table->string('mmc_motherreligion')->nullable();
            $table->string('mmc_motheraddress')->nullable();
            $table->string('mmc_motherphone')->nullable();
            $table->string('mmc_motheremail')->nullable();
            $table->string('mmc_motherjob')->nullable();
            $table->string('mmc_course')->nullable();
            $table->foreign('mmc_classid')
                ->references('mmc_classid')
                ->on('mmc_classes')
                ->onDelete('cascade');
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
        Schema::dropIfExists('mmc_students');
    }
}
