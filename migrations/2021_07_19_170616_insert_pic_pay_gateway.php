<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class InsertPicPayGateway extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('gateways')) {
            \DB::table('gateways')->insert([
                'code' => 'pic_pay_gateway',
                'icon' => 'vendor/hdelima/pic-pay-gateway/public/icon.png',
                'label' => 'PicPay',
                'enabled' => 0,
                'settings' => json_encode([
                    'x-picpay-token' => 'required',
                    'x-seller-token' => 'required'
                ]),
            ]);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasTable('gateways')) {
            \DB::table('gateways')
                ->where('code', 'pic-pay-gateway')
                ->delete();
        }
    }
}
