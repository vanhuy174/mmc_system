<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMmcPointdetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mmc_pointdetails', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('mmc_semesterid')->nullable();
            $table->string('mmc_studentid');
            $table->string('mmc_subjectid')->nullable();
            $table->string('mmc_yearid')->nullable();
            $table->text('mmc_10grade');
            $table->text('mmc_4grade');
            $table->integer('key')->nullable();
            $table->foreign('mmc_semesterid')
                ->references('mmc_semesterid')
                ->on('mmc_semesters')
                ->onDelete('cascade');
            $table->foreign('mmc_subjectid')
                ->references('mmc_subjectid')
                ->on('mmc_subjects')
                ->onDelete('cascade');
            $table->foreign('mmc_yearid')
                ->references('mmc_yearid')
                ->on('mmc_schoolyears')
                ->onDelete('cascade');
            $table->foreign('mmc_studentid')
                ->references('mmc_studentid')
                ->on('mmc_students')
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
        Schema::dropIfExists('mmc_pointdetails');
    }
}
