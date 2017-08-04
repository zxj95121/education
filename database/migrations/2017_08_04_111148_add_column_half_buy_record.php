<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnHalfBuyRecord extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('half_buy_record', function (Blueprint $table) {
            $table->decimal('price')->comment('总价格')->after('record_num');
            $table->tinyInteger('pay_status')->default('0')->comment('0表示未支付，1表示已支付')->after('record_num');
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
