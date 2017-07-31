<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyNewUserChat extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('new_user', function(Blueprint $table){
            $table->tinyInteger('is_chat')->default('0')->comment('1表示正在聊天中,0表示已挂断');
            $table->tinyInteger('worker_id')->nullable()->comment('socker进程的ID');
        });

        Schema::table('admin_info', function(Blueprint $table){
            $table->dropColumn('is_chat');
            $table->dropColumn('worker_id');
        });
        Schema::table('parent_info', function(Blueprint $table){
            $table->dropColumn('is_chat');
            $table->dropColumn('worker_id');
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
