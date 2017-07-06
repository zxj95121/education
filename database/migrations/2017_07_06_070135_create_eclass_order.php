<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEclassOrder extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('eclass_order', function (Blueprint $table) {
            $table->increments('id')->comment('主键');
            $table->string('uid')->comment('订单用户id');
            $table->string('tid')->comment('订单三级课程id');
            $table->integer('count')->comment('课时数量');
            $table->decimal('price', 10, 2)->comment('订单价格');
            $table->string('pay_status')->default('0')->comment('订单支付状态,0未支付，1已支付');
            $table->string('confirm_status')->default('0')->comment('订单支付状态,1表示已确认通过，0表示未确认，2表示订单被驳回');
            $table->string('assign')->nullable()->comment('订单分配状态情况');
            $table->tinyInteger('status')->default('1')->comment('1可用,0表示订单已删除');
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
