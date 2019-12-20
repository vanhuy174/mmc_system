<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMmcClassesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mmc_classes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('mmc_classid')->unique();
            $table->string('mmc_classname');
            $table->integer('mmc_numstudent')->nullable();
            $table->string('mmc_major');
            $table->string('mmc_headteacher')->nullable();
            $table->string('mmc_monitor')->nullable();
            $table->string('mmc_vicemonitor01')->nullable();
            $table->string('mmc_vicemonitor')->nullable();
            $table->string('mmc_secretary')->nullable();
            $table->string('mmc_vicesecretary1')->nullable();
            $table->string('mmc_vicesecretary2')->nullable();
            $table->string('mmc_ctdt');
            $table->text('mmc_description')->nullable();
            $table->foreign('mmc_major')
                ->references('mmc_majorid')
                ->on('mmc_majors')
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
        Schema::dropIfExists('mmc_classes');
    }
}
