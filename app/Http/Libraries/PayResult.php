<?php
namespace App\Http\Libraries;

use Illuminate\Support\ServiceProvider;
use Session;

use App\Http\Controllers\TemplateController;

use App\Models\NewUser;
use App\Models\BigOrder;
use App\Models\ClassPackageOrder;

class PayResult extends ServiceProvider
{
	/**
	* @author 张贤健
	* @function give
	* @program $price
	*/
	public static function give($price, $openid)
	{
		// ------------------------------------------------------------------------
        //满减等活动
        /*1、送加辰币*/
        // 满1000送100
        $count = floor($price/1000);


        $coin = $price*100;

        $pre_coin = NewUser::where('openid', $openid)
            ->get()[0]
            ->coin;
        $coin += (int)$pre_coin;
        NewUser::where('openid', $openid)
            ->update(['coin'=>$coin]);
        /*2、满3000送188元英语主题party一次*/

    }

    public static function editBigOrderVoucher($openid, $order_no)
    {
        $voucher_num = BigOrder::where('order_no', $order_no)
            ->select('voucher_num')
            ->get()[0]
            ->voucher_num;

        $voucher = NewUser::where('openid', $openid)
            ->select('voucher')
            ->get()[0]
            ->voucher;

        $voucher = $voucher - $voucher_num;

        if ($voucher < 0) {
            /*该订单存在逃钱问题*/
            TemplateController::send('obvbMv1cWutdUE5jwQTiod5bFuVY','关于某笔订单有问题的通知',$order_no,'-','-',date('Y-m-d H:i:s'),'','该订单并无优惠券可用，但却使用了。','');
            NewUser::where('openid', $openid)
                ->update(['voucher'=>'3888']);

        } else {
            NewUser::where('openid', $openid)
                ->update(['voucher'=>'1888']);
        }
    }

    public function editClassPackageOrderVoucher($openid, $order_no)
    {
        $voucher_num = ClassPackageOrder::where('order_no', $order_no)
            ->select('voucher_num')
            ->get()[0]
            ->voucher_num;

        $voucher = NewUser::where('openid', $openid)
            ->select('voucher')
            ->get()[0]
            ->voucher;

        $voucher = $voucher - $voucher_num;

        if ($voucher < 0) {
            /*该订单存在逃钱问题*/
            TemplateController::send('obvbMv1cWutdUE5jwQTiod5bFuVY','关于某笔订单有问题的通知',$order_no,'-','-',date('Y-m-d H:i:s'),'','该订单并无优惠券可用，但却使用了。','');
        } else {
            NewUser::where('openid', $openid)
                ->update(['voucher'=>$voucher]);
        }
    }
}

?>