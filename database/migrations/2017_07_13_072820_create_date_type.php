<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDateType extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('date_type', function (Blueprint $table) {
            $table->increments('id')->comment('主键');
            $table->date('day')->unique()->comment('日期');
            $table->string('type')->comment('是否为节假日，1为是，0为否');
            $table->tinyInteger('status')->default('1')->comment();
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
