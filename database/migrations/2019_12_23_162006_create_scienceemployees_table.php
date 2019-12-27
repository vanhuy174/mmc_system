<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateScienceemployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('scienceemployees', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('mmc_employeeid');
            $table->bigInteger('mmc_missionid')->unsigned();
            $table->string('mmc_link');
            $table->string('mmc_file');
            $table->integer('mmc_status');
            $table->foreign('mmc_employeeid')
                ->references('mmc_employeeid')->on('mmc_employees')
                ->onDelete('cascade');
            $table->foreign('mmc_missionid')
                ->references('id')->on('items')
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
        Schema::dropIfExists('scienceemployees');
    }
}
