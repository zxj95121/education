<?php
namespace App\Http\Libraries;

use Illuminate\Support\ServiceProvider;
use Session;
use DB;
use App\Models\NewUser;

class PayResult extends ServiceProvider
{
	/**
	* @author 张贤健
	* @function give
	* @program $price
	*/
	public static function give($price)
	{
		// ------------------------------------------------------------------------
        //满减等活动
        /*1、送加辰币*/
        // 满1000送100
        $count = floor($price/1000);


        $coin = $price*100;
        $coin = 5;

        $pre_coin = NewUser::where('openid', Session::get('openid'))
            ->first()
            ->coin;
        $coin += (int)$pre_coin;
        NewUser::where('openid', Session::get('openid'))
            ->update(['coin'=>$coin]);
        /*2、满3000送188元英语主题party一次*/

    }
}

?>