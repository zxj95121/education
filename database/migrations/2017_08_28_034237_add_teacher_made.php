<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTeacherMade extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tmade_parent_session', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('uid')->comment('new_user表ID');
            $table->integer('subject')->nullable()->comment('学科的ID，subject_two');
            $table->tinyInteger('education')->nullable()->comment('学历类型，1表示研究生，2表示本科生，3表示专科生');
            $table->tinyInteger('sex')->nullable()->comment('1男女均可，2男3女');
            $table->tinyInteger('type')->nullable()->comment('教学风格,1温和型，2严厉型，3幽默型');
            $table->string('hobby')->nullable()->comment('特长的id字符串');
            $table->tinyInteger('exp')->nullable()->comment('经验，1高中，2初中，3小学，4无经验');
            $table->integer('price')->nullable()->comment('学费，多少元一小时');
            $table->tinyInteger('time')->nullable()->comment('辅导时间，1周一到周五晚上，2周末，3节假日，4暑假，5寒假');
            $table->tinyInteger('status')->default('1')->comment('状态,1表示可用，0表示不可用');
            $table->timestamps();
        });
        
        Schema::create('tmade_parent', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('uid')->comment('new_user表ID');
            $table->integer('subject')->comment('学科的ID，subject_two');
            $table->tinyInteger('education')->nullable()->comment('学历类型，1表示研究生，2表示本科生，3表示专科生');
            $table->tinyInteger('sex')->nullable()->comment('1男女均可，2男3女');
            $table->tinyInteger('type')->nullable()->comment('教学风格,1温和型，2严厉型，3幽默型');
            $table->string('hobby')->nullable()->comment('特长的id字符串');
            $table->tinyInteger('exp')->nullable()->comment('经验，1高中，2初中，3小学，4无经验');
            $table->integer('price')->comment('学费，多少元一小时');
            $table->tinyInteger('time')->comment('辅导时间，1周一到周五晚上，2周末，3节假日，4暑假，5寒假');
            $table->tinyInteger('made_status')->default('1')->comment('1待确认，2待安排，3已定制');
            $table->tinyInteger('status')->default('1')->comment('状态,1表示可用，0表示不可用');
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
