<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubjectTwo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subject_two', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',36)->comment('课程名');
            $table->integer('pid')->comment('课程分类id');
            $table->tinyInteger('status')->default('1')->comment('状态1表示可用');
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
    }
}
