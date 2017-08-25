<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyPowerEclassPrice extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('admin_power', function (Blueprint $table) {
            $table->tinyInteger('modify_price')->default('0')->after('set_power')->comment('修改订单价格的权限，0表示无，1表示有');
        });

        Schema::create('modify_price_passwd', function (Blueprint $table) {
            $table->increments('id');
            $table->string('passwd')->comment('修改订单价格的口令');
            $table->tinyInteger('status')->default('1')->comment('状态,1可用');
            $table->timestamps();
        });

        Schema::create('modify_price_record', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('uid')->comment('修改人,admin_info的id');
            $table->decimal('pre', 10, 2)->comment('订单原价格');
            $table->decimal('now', 10, 2)->comment('订单修改后价格');
            $table->string('type')->comment('如何修改的');
            $table->tinyInteger('status')->default('1')->comment('状态,1可用');
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
