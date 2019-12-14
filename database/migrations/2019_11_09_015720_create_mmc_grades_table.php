<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMmcGradesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mmc_grades', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('mmc_studentid')->unique();
            $table->integer('mmc_tinchi');
            $table->float('mmc_10grade');
            $table->float('mmc_4grade');
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
        Schema::dropIfExists('mmc_grades');
    }
}
