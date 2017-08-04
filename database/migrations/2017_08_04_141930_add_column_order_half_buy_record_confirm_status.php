<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnOrderHalfBuyRecordConfirmStatus extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('half_buy_record', function (Blueprint $table) {
            $table->tinyInteger('confirm_status')->default('0')->comment('审核状态，1表示已确认，0表示未确认')->after('pay_status');
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
