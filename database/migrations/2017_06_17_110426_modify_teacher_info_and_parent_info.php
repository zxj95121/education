<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyTeacherInfoAndParentInfo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('teacher_detail', function (Blueprint $table) {
            $table->tinyInteger('sex')->nullable()->default('-1')->comment('0表示女，1表示男，-1表示未设置')->change();
            $table->string('birth', 7)->nullable()->change();
            $table->string('school')->nullable()->change();
            $table->string('subject')->nullable()->change();
            $table->string('money')->nullable()->change();
            $table->string('address')->nullable()->change();
            $table->string('teachYear', 4)->nullable()->change();
        });

        Schema::table('parent_detail', function (Blueprint $table) {
            $table->string('surname', 20)->nullable()->change();
            $table->tinyInteger('sex')->nullable()->default('-1')->comment('0表示妈妈，1表示爸爸，-1表示未设置')->change();
            $table->string('birth', 7)->nullable()->change();
            $table->string('address')->nullable()->change();
            $table->string('place')->nullable()->change();
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
