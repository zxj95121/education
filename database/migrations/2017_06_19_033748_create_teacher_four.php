<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTeacherFour extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teacher_four', function (Blueprint $table) {
        	$table->increments('id')->comment('主键');
        	$table->string('name')->comment('名称');
        	$table->integer('pid')->comment('teacherthree id');
        	$table->tinyInteger('status')->default('1')->comment('0为删除-1为隐藏');
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
        Schema::table('teacher_four', function (Blueprint $table) {
            //
        });
    }
}
