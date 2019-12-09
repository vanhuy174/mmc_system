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
            $table->text('diligentpoint')->nullable();    //điểm chuyên cần
            $table->text('point1')->nullable();   //điểm bài kiểm tra 1
            $table->text('point2')->nullable();   //điểm bài kiểm tra 2
            $table->text('point3')->nullable();   //điểm bài kiểm tra 3
            $table->text('point4')->nullable();   //điểm bài kiểm tra 4
            $table->text('testscore')->nullable();   //điểm thi cuối kỳ
            $table->string('mmc_note')->nullable();     //ghi chú
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
