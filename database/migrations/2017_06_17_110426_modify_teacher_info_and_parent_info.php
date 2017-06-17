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
            $table->string('sex', 1)->nullable()->change();
            $table->string('birth', 7)->nullable()->change();
            $table->string('school')->nullable()->change();
            $table->string('subject')->nullable()->change();
            $table->string('money')->nullable()->change();
            $table->string('address')->nullable()->change();
            $table->string('teachYear', 4)->nullable()->change();
        });

        Schema::table('parent_detail', function (Blueprint $table) {
            $table->string('surname', 20)->nullable()->change();
            $table->string('sex', 1)->nullable()->change();
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
