<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMuchCommunity extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /*城市*/
        Schema::create('community_city', function (Blueprint $table) {
            $table->increments('id')->comment('主键');
            $table->string('name')->comment('城市名称');
            $table->tinyInteger('status')->comment('1表示可用，0表示不可用');
            $table->timestamps();
        });
        /*区域*/
        Schema::create('community_area', function (Blueprint $table) {
            $table->increments('id')->comment('主键');
            $table->integer('cid')->comment('城市id');
            $table->string('name')->comment('区域名称');
            $table->tinyInteger('status')->comment('1表示可用，0表示不可用');
            $table->timestamps();
        });
        /*社区*/
        Schema::create('community_community', function (Blueprint $table) {
            $table->increments('id')->comment('主键');
            $table->integer('aid')->comment('区域id');
            $table->string('name')->comment('社区名称');
            $table->tinyInteger('status')->comment('1表示可用，0表示不可用');
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
