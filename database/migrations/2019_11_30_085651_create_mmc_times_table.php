<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMmcTimesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mmc_times', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('class_time');   //tiết học.
            $table->time('time_in');   //giờ vào lớp .
            $table->time('time_out');    //giờ ra chơi.
            $table->integer('season');    //mùa (mùa đông: 1,  Mùa hè: 2).
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
        Schema::dropIfExists('mmc_times');
    }
}
