<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSchoolTwo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('school_two', function (Blueprint $table) {
        	$table->increments('id')->comment('主键');
        	$table->tinyInteger('status')->default('1')->comment('状态1表示可用');
        	$table->string('name',30)->comment('学校名称');
        	$table->integer('pid')->comment('学校分类id');
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
        Schema::table('school_two', function (Blueprint $table) {
            //
        });
    }
}
