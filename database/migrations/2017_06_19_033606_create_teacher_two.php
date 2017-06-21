<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTeacherTwo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teacher_two', function (Blueprint $table) {
        	$table->increments('id')->comment('主键');
        	$table->string('name')->comment('名称');
        	$table->integer('pid')->comment('teacherone id');
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
        Schema::table('teacher_two', function (Blueprint $table) {
            //
        });
    }
}
