<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEclassProgress extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('eclass_progress', function (Blueprint $table) {
            $table->increments('id')->comment('主键');
            $table->integer('oid')->comment('订单id');
            $table->integer('fid')->comment('课程进度ID，teacher_four的id');
            $table->date('day')->comment('上课日期');
            $table->integer('ct_id')->comment('classTime的id，上课时间段');
            $table->tinyInteger('status')->default('1')->comment('1为数据可用，0为不可用');
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
