<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyHalfBuyRecord extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('half_buy_info', function (Blueprint $table) {
            $table->dropColumn('used_complete_num');
        });

        Schema::table('half_buy_record', function (Blueprint $table) {
            $table->integer('uid')->comment('new_user表 id')->change();
            $table->integer('tid')->comment('teacher_one的ID')->after('uid');
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
