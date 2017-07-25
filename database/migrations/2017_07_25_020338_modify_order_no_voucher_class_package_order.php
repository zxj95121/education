<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyOrderNoVoucherClassPackageOrder extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('class_package_order', function (Blueprint $table) {
            $table->string('order_no')->comment('套餐订单编号')->after('id');
            $table->integer('voucher_num')->comment('优惠券使用数量')->after('uid');
        });

        Schema::table('new_user', function (Blueprint $table) {
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
