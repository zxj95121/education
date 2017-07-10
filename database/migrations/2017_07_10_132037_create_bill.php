<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBill extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bill', function (Blueprint $table) {
            $table->increments('id')->comment('主键');
            $table->string('transaction_id')->unique()->comment('微信微信订单号');
            $table->string('type')->default('EC')->comment('支付类型 EC表示eclass订单');
            $table->integer('oid')->comment('订单id');
            $table->string('openid')->comment('微信号');
            $table->tinyInteger('status')->default('1')->comment();
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
        Schema::dropIfExists('bill');
    }
}
