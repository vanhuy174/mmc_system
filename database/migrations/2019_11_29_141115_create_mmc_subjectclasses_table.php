<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMmcSubjectclassesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mmc_subjectclasses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('mmc_subjectclassid')->index(); //mã lớp học phần.
            $table->string('mmc_subjectclassname');   //tên lớp học phần.
            $table->string('mmc_employeeid')->index();   //mã giảng viên.
            $table->string('mmc_subjectid');    //mã học phần.
            $table->string('mmc_semester');    //ky hoc.
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
        Schema::dropIfExists('mmc_subjectclasses');
    }
}
