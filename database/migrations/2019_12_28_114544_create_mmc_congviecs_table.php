<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMmcCongviecsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mmc_congviecs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('mmc_nguoigui'); // người gửi
            $table->string('mmc_nguoinhan'); //người nhận
            $table->string('mmc_tieude')->nullable(); //tiêu đề
            $table->text('mmc_noidung')->nullable(); //nội dung
            $table->text('mmc_ghichu')->nullable();  //ghi chú
            $table->integer('mmc_trangthai')->nullable();  //trạng thái
            $table->date('mmc_batdau')->nullable();  //bắt đầu
            $table->date('mmc_ketthuc')->nullable();  //kết thúc
            $table->string('mmc_ketqua')->nullable();  //kết thúc
            $table->text('mmc_nhanxet')->nullable();  //đánh giá
            $table->string('mmc_cv')->nullable();  //công việc chung

            $table->foreign('mmc_nguoinhan')
                ->references('mmc_employeeid')->on('mmc_employees')
                ->onDelete('cascade');
            $table->foreign('mmc_nguoigui')
                ->references('mmc_employeeid')->on('mmc_employees')
                ->onDelete('cascade');
            $table->timestamps();
        });
        Artisan::call('db:seed');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mmc_congviecs');
    }
}
