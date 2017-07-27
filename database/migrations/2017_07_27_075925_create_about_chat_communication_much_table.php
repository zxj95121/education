<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAboutChatCommunicationMuchTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // 权限表
        Schema::create('admin_power', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('uid')->comment('admin_info表的id');
            $table->tinyInteger('chat')->default('0')->comment('沟通的权限，0表示无沟通权限，1表示有');
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
        //
    }
}
