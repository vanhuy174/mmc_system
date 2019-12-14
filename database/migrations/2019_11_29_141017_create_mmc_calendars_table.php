<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMmcCalendarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mmc_calendars', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('mmc_subjectclassid')->index(); //mã lớp học phần 
            $table->date('mmc_schedule');   //ngày học
            $table->string('mmc_class');   //tiết học học
            $table->string('mmc_classroom');    //phòng học
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
        Schema::dropIfExists('mmc_calendars');
    }
}
