<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoinRecords extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::create('coin_record', function (Blueprint $table) {
        //     $table->increments('id');
        //     $table->string('uid')->comment('new_user表 id');
        //     $table->tinyInteger('type')->comment('1表示双师class订单，2表示其他class订单');
        //     $table->integer('coin')->comment('coin表示加辰币不可用金额');
        //     $table->tinyInteger('status')->default(1)->comment('1表示可用');
        //     $table->timestamps();
        // });

        Schema::table('new_user', function (Blueprint $table) {
            // $table->integer('uncoin')->nullable()->comment('不可用加辰币')->after('headimg');
            $table->integer('coin')->default(0)->comment('可用加辰币')->after('headimg');
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
