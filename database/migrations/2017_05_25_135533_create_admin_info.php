<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminInfo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_info', function (Blueprint $table) {
            $table->increments('id')->comment('自增ID');
            $table->string('openid')->unique()->comment('用户openid,唯一索引,数字字母下划线(<=20字符)');
            $table->string('name')->comment('管理员昵称');
            $table->string('password')->comment('密码');
            $table->string('headimg')->comment('头像地址');
            $table->tinyInteger('status')->comment('1表示可用，0表示尚未通过审核，-1表示已删除');
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
        Schema::dropIfExists('admin_info');
    }
}
