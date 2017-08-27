<?php
namespace App\Http\Libraries;

use Illuminate\Support\ServiceProvider;
use Session;

use App\Http\Controllers\TemplateController;

use App\Models\NewUser;
use App\Models\BigOrder;
use App\Models\ClassPackageOrder;
use App\Models\PatyRecord;

class PayResult extends ServiceProvider
{
	/**
	* @author 张贤健
	* @function give
	* @program $price
	*/
	public static function give($price, $openid ,$oid)
	{
		// ------------------------------------------------------------------------
        //满减等活动
        /*1、送加辰币*/
        // 满1000送100
        $count = floor($price/1000);


        $coin = $count*100;

        $pre_coin = NewUser::where('openid', $openid)
            ->get()[0]
            ->coin;
        $coin += (int)$pre_coin;
        NewUser::where('openid', $openid)
            ->update(['coin'=>$coin]);
        /*2、满3000送188元英语主题party一次*/
        if ($count >= 3) {
        	$userObj = NewUser::where('openid', $openid)
        		->first();
        	$paty = $userObj->paty + 1;
        	$userObj->paty = $paty;
        	$userObj->save();
        	
        	$bigObj = BigOrder::find($oid);
        	$paty = $bigObj->paty + 1;
        	$bigObj->paty = $paty;
        	$bigObj->save();
        	
        }

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

        $voucher = $voucher - $voucher_num*88;

        if ($voucher < 0) {
            /*该订单存在逃钱问题*/
            $pre = floor($voucher/88);
            TemplateController::send('obvbMv1cWutdUE5jwQTiod5bFuVY','关于某笔双师订单有问题的通知',$order_no,'使用了优惠券'.$voucher_num.'个','原来有优惠券'.$pre.'个',date('Y-m-d H:i:s'),'','该订单并无优惠券可用，但却使用了。','');
        } else {
            NewUser::where('openid', $openid)
                ->update(['voucher'=>$voucher]);
        }
    }

    public static function editClassPackageOrderVoucher($openid, $order_no)
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
            $pre = floor($voucher/88);
            TemplateController::send('obvbMv1cWutdUE5jwQTiod5bFuVY','关于某笔其他class订单有问题的通知',$order_no,'使用了优惠券'.$voucher_num.'个','原来有优惠券'.$pre.'个',date('Y-m-d H:i:s'),'','该订单并无优惠券可用，但却使用了。','');
        } else {
            NewUser::where('openid', $openid)
                ->update(['voucher'=>$voucher]);
        }
    }
}

?>