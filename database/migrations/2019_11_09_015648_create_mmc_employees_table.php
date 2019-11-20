<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMmcEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mmc_employees', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('mmc_employeeid')->unique();
            $table->string('mmc_name');
            $table->string('mmc_avatar')->nullable();
            $table->string('password');
            $table->string('mmc_deptid')->nullable();
            $table->date('mmc_dateofbirth')->nullable();
            $table->string('mmc_phone',12)->nullable();
            $table->string('email')->unique();
            $table->tinyInteger('mmc_gender')->nullable();
            $table->string('mmc_placeofbirth')->nullable();
            $table->string('mmc_hometown')->nullable();
            $table->string('mmc_address')->nullable();
            $table->string('mmc_religion')->nullable();
            $table->string('mmc_ethnic')->nullable();
            $table->date('mmc_dateofrecruit')->nullable();
            $table->string('mmc_position')->nullable();
            $table->string('mmc_maintask')->nullable();
            $table->string('mmc_nameofjob')->nullable();
            $table->string('mmc_codeofjob')->nullable();
            $table->float('mmc_salarylevel')->nullable();
            $table->float('mmc_salaryratio')->nullable();
            $table->float('mmc_salaryposition')->nullable();
            $table->float('mmc_salaryother')->nullable();
            $table->string('mmc_degree')->nullable();
            $table->string('mmc_politiclevel')->nullable();
            $table->string('mmc_managementlevel')->nullable();
            $table->string('mmc_language')->nullable();
            $table->string('mmc_itlevel')->nullable();
            $table->date('mmc_partydate')->nullable();
            $table->date('mmc_partydateprimary')->nullable();
            $table->string('mmc_reward')->nullable();
            $table->string('mmc_discipline')->nullable();
            $table->string('mmc_heathlevel')->nullable();
            $table->float('mmc_tall')->nullable();
            $table->float('mmc_weight')->nullable();
            $table->string('mmc_bloodgroup')->nullable();
            $table->string('mmc_personalid')->nullable();
            $table->date('mmc_dateofpid')->nullable();
            $table->string('mmc_socialinsuranceid')->nullable();
            $table->string('mmc_level')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('mmc_employees');
    }
}
