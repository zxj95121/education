<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyClassPackageAddTableClassPackageOrder extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('class_package', function (Blueprint $table) {
            $table->integer('order_count')->default(0)->comment('该课程套餐的订单数量')->after('show');
        });

        Schema::create('class_package_order', function (Blueprint $table) {
            $table->increments('id')->comment('主键');
            $table->integer('cid')->comment('课程套餐的ID');
            $table->integer('uid')->comment('new_user表的ID');
            $table->integer('count')->comment('该订单使用优惠券数量');
            $table->decimal('price', 10, 2)->comment('该订单实际价格');
            $table->tinyInteger('status')->default('1')->comment('1表示可用');
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
