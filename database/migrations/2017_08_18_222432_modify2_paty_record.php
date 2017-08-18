<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Modify2PatyRecord extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('paty_record', function (Blueprint $table) {
            $table->tinyInteger('type')->default('1')->comment('1表示big_order,2表示class_package_order');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('paty_record', function (Blueprint $table) {
            //
        });
    }
}
