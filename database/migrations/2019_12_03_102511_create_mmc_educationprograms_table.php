<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMmcEducationprogramsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mmc_educationprograms', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('mmc_subjectid');
            $table->string('mmc_majorid');
            $table->string('mmc_course');
            $table->string('mmc_semester');
            $table->string('mmc_classify');
            $table->string('mmc_elective')->nullable();
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
        Schema::dropIfExists('mmc_educationprograms');
    }
}
