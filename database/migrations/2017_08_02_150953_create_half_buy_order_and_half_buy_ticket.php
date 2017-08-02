<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHalfBuyOrderAndHalfBuyTicket extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('half_buy_info', function (Blueprint $table) {
            $table->increments('id');
            $table->string('uid')->comment('new_user表 id');
            $table->string('ticket_num')->comment('半价券的剩余数量');
            $table->tinyInteger('used_num')->default(0)->comment('已用的半价券的数量');
            $table->tinyInteger('used_complete_num')->default(0)->comment('已用中已完成上课的数量');
            $table->tinyInteger('status')->default(1)->comment('1表示可用');
            $table->timestamps();
        });

        Schema::table('new_user', function (Blueprint $table) {
            $table->string('phone', 30)->nullable()->comment('用户手机号')->change();
        });

        Schema::create('half_buy_record', function (Blueprint $table) {
            $table->increments('id');
            $table->string('uid')->comment('new_user表 id');
            $table->string('record_num')->comment('本次使用的数量');
            $table->tinyInteger('status')->default(1)->comment('1表示可用');
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
