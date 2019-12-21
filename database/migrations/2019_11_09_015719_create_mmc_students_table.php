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
            $table->string('mmc_studentid')->unique();
            $table->string('mmc_classid');
            $table->string('mmc_fullname')->nullable();
            $table->date('mmc_dateofbirth')->nullable();
            $table->tinyInteger('mmc_gender')->nullable();
            $table->string('mmc_email')->nullable();
            $table->string('mmc_phone')->nullable();
            $table->string('mmc_address')->nullable();
            $table->string('mmc_ethnic')->nullable();
            $table->string('mmc_religion')->nullable();
            $table->string('mmc_reward')->nullable();
            $table->string('mmc_descipline')->nullable();
            $table->string('mmc_personalid')->nullable();
            $table->string('mmc_status')->nullable();
            $table->string('mmc_father')->nullable();
            $table->string('mmc_fathernationality')->nullable();
            $table->string('mmc_fatherethnic')->nullable();
            $table->string('mmc_fatherreligion')->nullable();
            $table->string('mmc_fatheraddress')->nullable();
            $table->string('mmc_fatherphone')->nullable();
            $table->string('mmc_fatheremail')->nullable();
            $table->string('mmc_fatherjob')->nullable();
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
