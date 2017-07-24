<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClassPackage extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('class_package', function (Blueprint $table) {
            $table->increments('id')->comment('主键');
            $table->string('name')->comment('套餐名称');
            $table->decimal('price', 10, 2)->comment('套餐价格');
            $table->text('show')->nullable()->comment('界面展示html代码');
            $table->tinyInteger('status')->default('1')->comment('1表示可用');
            $table->timestamps();
        });

        Schema::table('bit_order', function (Blueprint $table) {
            $table->decimal('price', 10, 2)->comment('订单总价格')->change();
        });

        Schema::rename('bit_order', 'big_order');
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
