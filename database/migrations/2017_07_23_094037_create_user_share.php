<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserShare extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_share', function (Blueprint $table) {
            $table->increments('id')->comment('new_userid');
            $table->string('openid')->comment('推荐openid');
            $table->tinyInteger('subscribe')->comment('是否关注 0表示为关注 1表示关注');
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
        Schema::dropIfExists('user_share');
    }
}
