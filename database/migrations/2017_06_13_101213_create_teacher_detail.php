<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTeacherDetail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teacher_detail', function (Blueprint $table) {
            $table->increments('id')->comment('主键');
            $table->integer('tid')->comment('教师id');
            $table->tinyInteger('type')->default('1')->comment('1表示大学生教师，2表示职业教师');

            $table->string('name', 36)->nullable()->comment('姓名');
            $table->tinyInteger('sex')->default('0')->comment('0表示女,1表示男');
            $table->string('birth', 7)->comment('出生年月');
            $table->string('school')->comment('所在学校');

            $table->string('project')->nullable()->comment('所学专业');
            $table->string('studentimgurl')->nullable()->comment('校园卡图片地址');
            $table->string('teacherimgurl')->nullable()->comment('教师资格证图片地址');
            $table->string('advantage')->nullable()->comment('优势说明文字，80字以内。可不填');
            $table->string('advantageimgurl')->nullable()->comment('其他（优势）照片附加');

            $table->string('subject')->comment('擅长学科,多个');
            $table->string('money')->comment('期望薪资');
            $table->string('address')->comment('期望教学社区');

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
        //
    }
}
