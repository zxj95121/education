<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserChatOtherThing extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contact_chat', function (Blueprint $table) {
            $table->increments('id')->comment('主键');
            $table->integer('uid')->comment('parent_info表的id');
            $table->integer('admin_id')->comment('admin_info表的id');
            $table->text('content')->comment('聊天内容或图片url地址');
            $table->tinyInteger('read')->comment('0表示未读，1表示已读');
            $table->tinyInteger('status')->default('1')->comment('1可用 0不可用');
            $table->timestamps();
        });

        Schema::table('parent_info', function(Blueprint $table){
            $table->tinyInteger('is_chat')->default('0')->comment('1表示正在聊天中,0表示已挂断');
            $table->tinyInteger('worker_id')->nullable()->comment('socker进程的ID');
        });

        Schema::table('admin_info', function(Blueprint $table){
            $table->tinyInteger('is_chat')->default('0')->comment('1表示正在聊天中,0表示已挂断');
            $table->tinyInteger('worker_id')->nullable()->comment('socker进程的ID');
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
