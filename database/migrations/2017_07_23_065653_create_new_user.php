<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('new_user', function (Blueprint $table) {
            $table->increments('id');
            $table->string('openid')->comment('微信id');
            $table->tinyInteger('type')->comment('系统成员 0表示非系统成员');
            $table->string('phone')->comment('手机号');
            $table->string('headimg')->comment('微信头像');
            $table->string('nickname')->comment('昵称');
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
        Schema::dropIfExists('new_user');
    }
}
