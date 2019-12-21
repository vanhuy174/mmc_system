<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMmcStudentpointsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mmc_studentpoints', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('mmc_studentid');    //mã sinh viên
            $table->string('mmc_subjectclassid');   //mã lớp học phần
            $table->string('mmc_subjectid');   //mã học phần
            $table->text('diligentpoint')->nullable();    //điểm chuyên cần
            $table->text('point1')->nullable();   //điểm bài kiểm tra 1
            $table->text('point2')->nullable();   //điểm bài kiểm tra 2
            $table->text('point3')->nullable();   //điểm bài kiểm tra 3
            $table->text('point4')->nullable();   //điểm bài kiểm tra 4
            $table->text('testscore')->nullable();   //điểm thi cuối kỳ
            $table->integer('point_ratio')->nullable();   //Tỉ lệ giữa điểm thường xuyên và điểm thi
            $table->text('mmc_10grade')->nullable();   //Điểm hs 10
            $table->text('mmc_4grade')->nullable();   //Điểm hs 4
            $table->string('mmc_note')->nullable();     //ghi chú
            $table->integer('mmc_key')->nullable();     //Lần học
            $table->timestamps();

            $table->foreign('mmc_studentid')
                ->references('mmc_studentid')
                ->on('mmc_students')
                ->onDelete('cascade');

            $table->foreign('mmc_subjectclassid')
                ->references('mmc_subjectclassid')
                ->on('mmc_subjectclasses')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mmc_studentpoints');
    }
}
