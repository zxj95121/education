<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClassTimeParent extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('class_time', function (Blueprint $table) {
            $table->increments('id')->comment('主键');
            $table->string('type')->comment('1表示周一到中午,2表示周末和节假日');
            $table->string('low')->comment('低区间');
            $table->string('high')->comment('高区间');
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
