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
            $table->string('openid')->unique()->comment('用户openid,唯一索引');
            $table->string('nickname')->comment('管理员昵称,默认微信昵称');
            $table->string('name')->comment('管理员真实姓名');
            $table->string('phone', 12)->comment('11位手机号');
            $table->string('password')->comment('登录密码（字母数字6-18位）');
            $table->string('headimg')->comment('头像地址，默认微信头像，否则使用系统默认');
            $table->tinyInteger('scan_id')->default('0')->comment('登录对应二维码图片ID，0未登录，其他表示对应ID');
            $table->tinyInteger('status')->default('0')->comment('1表示可用，0表示尚未通过审核，-1表示已删除');
            $table->tinyInteger('identity')->default('0')->comment('是否为超级管理员，0为否,1位真');
            $table->integer('count')->default('1')->comment('登录次数');
            $table->timestamps();
        });

        Schema::create('admin_scan_login', function (Blueprint $table) {
            $table->increments('id')->comment('自增ID');
            $table->integer('admin_id')->default('0')->comment('管理员ID');
            $table->string('scan_url')->comment('图片路径');
            $table->string('status')->default('1')->comment('图片状态，1表示正在用未扫码，2表示正在用，已扫码3表示正在用已成功输入密码，操作完成。');
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
        Schema::dropIfExists('admin_scan_login');
    }
}
