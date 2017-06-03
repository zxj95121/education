<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserStudentsAndTeacherInfo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parent_info', function (Blueprint $table) {
            $table->increments('id')->comment('自增ID');
            $table->string('openid', 255)->unique()->comment('用户openid,唯一索引');
            $table->integer('profile_id')->nullable()->comment('个人提供审核的资料ID');
            $table->string('phone', 12)->comment('11位手机号');
            $table->string('name', 48)->comment('家长昵称，默认存微信昵称,48字符以内');
            $table->string('headimg')->comment('头像地址,默认微信图像，没有采用系统默认头像');
            $table->tinyInteger('status')->default('0')->comment('0表示未认证，1表示已认证，-1表示已删除');
            $table->integer('count')->default('1')->comment('登录次数');
            $table->timestamps();
        });

        /*教师信息表*/
        Schema::create('teacher_info', function (Blueprint $table) {
            $table->increments('id')->comment('自增ID');
            $table->string('openid', 255)->unique()->comment('用户openid,唯一索引');
            $table->integer('profile_id')->nullable()->comment('个人提供审核的资料ID');
            $table->string('phone', 12)->comment('11位手机号');
            $table->string('name', 48)->comment('教师昵称，默认存微信昵称,48字符以内');
            $table->string('headimg')->comment('头像地址,默认微信图像，没有采用系统默认头像');
            $table->tinyInteger('status')->default('0')->comment('0表示未认证，1表示已认证，-1表示已删除');
            $table->integer('count')->default('1')->comment('登录次数');
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
        Schema::dropIfExists('parent_info');
        Schema::dropIfExists('teacher_info');
    }
}
