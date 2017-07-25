<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyBigOrderAddColumnPayStatus extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('big_order', function (Blueprint $table) {
            $table->tinyInteger('pay_status')->default(0)->comment('订单支付状态,0表示未支付，1表示已支付，2表示已退款')->after('confirm_status');
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
