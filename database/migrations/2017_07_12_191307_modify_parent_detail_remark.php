<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyParentDetailRemark extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('parent_detail', function (Blueprint $table) {
            $table->string('time_remark')->nullable()->comment('时间安排备注')->after('place');
        });

        Schema::table('order_class_time', function (Blueprint $table) {
            $table->string('type')->default('1')->comment('1表示节假日，0表示上课时间')->after('ct_id');
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
