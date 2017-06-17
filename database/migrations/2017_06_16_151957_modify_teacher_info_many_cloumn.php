<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyTeacherInfoManyCloumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('teacher_info', function (Blueprint $table) {
            $table->dropColumn('profile_id');
        });

        Schema::table('teacher_detail', function (Blueprint $table) {
            $table->dropColumn('studentimgurl');
            $table->dropColumn('teacherimgurl');
            $table->dropColumn('advantageimgurl');
            $table->string('teachYear', 4)->after('address')->comment('对于教师就是开始教学的年份，对于学生就是上大学的年份');
            $table->tinyInteger('find_status')->default('1')->after('subject')->comment('1表示找兼职，0表示暂不考虑求职，2表示找全职');
        });

        Schema::create('advatage_img', function (Blueprint $table) {
            $table->increments('id')->comment('主键');
            $table->string('imgurl')->comment('图片地址');
            $table->integer('did')->comment('detail的id,对应的是用户');
            $table->tinyInteger('status')->default('1')->comment('状态1表示可用,0不可用');
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
