<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDiscount extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('discount', function (Blueprint $table) {
            $table->increments('id');
            $table->decimal('discount_price', 10, 2)->comment('抢课价格');
            $table->integer('pid')->comment('class_package表 id');
            $table->dateTime('start_time')->comment('活动开始时间');
            $table->string('probability')->comment('获奖概率');
            $table->tinyInteger('status')->default('1')->comment('1可用 0不可用');
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
        Schema::dropIfExists('discount');
    }
}
