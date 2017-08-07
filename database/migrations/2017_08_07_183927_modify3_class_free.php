<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Modify3ClassFree extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('class_free', function (Blueprint $table) {
            $table->tinyInteger('type')->default('0')->comment('0表示未发送通知 1表示已发送通知');
            $table->dateTime('active_time')->comment('预约时间')->nullable()->change();
       		$table->date('active_date')->comment('预约日期')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('class_free', function (Blueprint $table) {
            //
        });
    }
}
