<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBigOrder extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bit_order', function (Blueprint $table) {
            $table->increments('id')->comment('主键');
            $table->string('openid')->comment('微信openid');
            $table->integer('count')->comment('总课时数量');
            $table->integer('price')->comment('订单总价格');
            $table->tinyInteger('status')->default('1')->comment('1表示可用');
            $table->timestamps();
        });

        Schema::table('eclass_order', function (Blueprint $table) {
            $table->tinyInteger('bid')->comment('big_order的id')->after('price');
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
