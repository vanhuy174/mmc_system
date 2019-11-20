<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMmcSubjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mmc_subjects', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('mmc_subjectid')->unique();
            $table->string('mmc_subjectname');
            $table->integer('mmc_tinchi');
            $table->text('mmc_description')->nullable();

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
        Schema::dropIfExists('mmc_subjects');
    }
}
