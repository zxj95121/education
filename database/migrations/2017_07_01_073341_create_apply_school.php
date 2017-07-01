<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApplySchool extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('school_apply', function (Blueprint $table) {
            $table->increments('id')->comment('主键');
            $table->string('name')->comment('学校名称');
            $table->string('openid')->comment('用户openid');
            $table->tinyInteger('status')->default('0')->comment('0为待审核,1为审核通过，-1为审核不通过');
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
