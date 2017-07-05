<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCloumnPreferTime extends Migration
{
    /**
     * Run the migrations.                       
     *
     * @return void
     */
    public function up()
    {
        Schema::table('parent_detail', function (Blueprint $table) {
            $table->string('prefer_time')->nullable()->comment('期望课程的教学时间段')->after('pid');
            $table->string('prefer_type')->nullable()->default('1')->comment('1表示有加辰安排，2表示自己有计划')->after('pid');
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
