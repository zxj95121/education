<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrerateVoucherRecord extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('voucher_record', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('uid')->comment('new_user表ID');
            $table->integer('voucher')->comment('添加的优惠券的金额');
            $table->tinyInteger('status')->default('1')->comment('状态,1表示已启用，0表示已取消该添加');
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
        //
    }
}
