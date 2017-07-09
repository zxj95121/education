<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyParentDetailCreateOrderClass extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('parent_detail', function (Blueprint $table) {
            $table->string('classTimes', 2)->nullable()->comment('表示一周上多少节课')->after('address');
        });

        Schema::create('order_class_time', function (Blueprint $table) {
            $table->increments('id')->comment('主键');
            $table->integer('order_id')->comment('订单ID');
            $table->integer('class_id')->comment('班级ID');
            $table->tinyInteger('week')->comment('周几');
            $table->tinyInteger('status')->default('1')->comment('1可用,0不可用');
            $table->timestamps();
        });

        Schema::create('class', function(Blueprint $table) {
            $table->increments('id')->comment('主键');
            $table->string('name')->comment('班级名称');
            $table->integer('people')->comment('班级人数');
            $table->tinyInteger('status')->default('1')->comment('1可用,0不可用');
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
