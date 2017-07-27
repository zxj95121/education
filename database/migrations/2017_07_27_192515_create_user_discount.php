<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserDiscount extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_discount', function (Blueprint $table) {
            $table->increments('id');
            $table->string('uid')->comment('new_user表 id');
            $table->string('discount_id')->comment('discount表 id');
            $table->tinyInteger('type')->default(0)->comment('0等待抽奖  -1表示未中奖  1表示中奖');
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
        Schema::dropIfExists('user_discount');
    }
}
