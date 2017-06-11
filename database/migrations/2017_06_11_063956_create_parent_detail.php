<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateParentDetail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parent_detail', function (Blueprint $table) {
        	$table->increments('id')->comment('主键');
        	$table->integer('pid')->comment('学生家长id');
        	$table->string('name', 36)->nullable()->comment('姓名');
        	$table->string('surname', 6)->comment('姓氏');
        	$table->tinyInteger('sex')->default('0')->comment('0表示妈妈,1表示爸爸');
        	$table->string('birth', 7)->comment('出生年月');
        	$table->string('address')->comment('市住宅小区');
        	$table->string('place')->comment('单元栋楼层');
        	$table->tinyInteger('status')->default('1')->comment('状态 1表示可用');
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
    	Schema::drop('parent_detail');
    }
}
