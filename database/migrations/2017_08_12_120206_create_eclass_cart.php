<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEclassCart extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('eclass_cart', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('uid')->comment('new_user表ID');
            $table->string('total')->comment('cartTotal');
            $table->text('arr')->comment('cartArr');
            $table->text('order')->comment('cartOrder');
            $table->tinyInteger('status')->default('1')->comment('状态');
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
