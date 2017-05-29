<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOauthUrlRedirect extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('oauth_url_redirect', function (Blueprint $table) {
            $table->increments('id')->comment('自增ID,进行网页授权时候加前缀url');
            $table->string('url')->comment('要跳转的url路径');
            $table->string('scope')->default('snsapi_userinfo')->comment('授权方式，默认为需要用户主动确认');
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
        Schema::dropIfExists('oauth_url_redirect');
    }
}
