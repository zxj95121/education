<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyNewUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('new_user', function (Blueprint $table) {
        	$table->string('type', 2)->comment('0表示未注册 1表示已注册')->change();
        	$table->integer('uid')->comment('user_type表 id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('new_user', function (Blueprint $table) {
            //
        });
    }
}
