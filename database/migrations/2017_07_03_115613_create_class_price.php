<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClassPrice extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('class_price', function (Blueprint $table) {
            $table->increments('id')->comment('主键');
            $table->string('area')->comment('价格区间');
            $table->string('price')->comment('对应的价格');
            $table->tinyInteger('status')->default('0')->comment('1可用,0不可用');
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
