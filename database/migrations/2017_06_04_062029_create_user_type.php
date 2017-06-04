<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserType extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_type', function (Blueprint $table) {
            $table->increments('id')->comment('自增ID');
            $table->string('openid', 255)->unique()->comment('用户openid,唯一索引');
            $table->string('type')->default(1)->comment('用户类别，1表示管理员，2表示家长，3表示家教老师');
            $table->tinyInteger('status')->default('1')->comment('1可用，0不可用');
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
        Schema::dropIfExists('user_type');
    }
}
