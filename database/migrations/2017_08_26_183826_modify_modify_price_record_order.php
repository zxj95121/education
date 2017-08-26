<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyModifyPriceRecordOrder extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('modify_price_record', function (Blueprint $table) {
            $table->tinyInteger('which')->default(1)->comment('1表示双师class订单,2表示其他class订单')->after('uid');
            $table->string('order_no')->comment('订单编号')->after('now');
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
