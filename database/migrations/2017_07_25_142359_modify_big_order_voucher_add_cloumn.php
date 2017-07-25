<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyBigOrderVoucherAddCloumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('big_order', function (Blueprint $table) {
            $table->integer('voucher_num')->comment('优惠券使用数量')->after('price');
        });

        Schema::table('user_share', function (Blueprint $table) {
            $table->string('openid')->unique()->comment('openid')->after('id')->change();
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
