<?php

namespace App\Http\Controllers\Front\Parent;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\ParentInfo;
use App\Models\ContactChat;
use App\Models\ParentDetail;
use App\Models\NewUser;

use Session;
use Wechat;

class ChatController extends Controller
{
    public function home()
    {
    	$openid = Session::get('openid');
    	$count = NewUser::where('openid', $openid)->count();
    	if ($count == 0) {
    		/*将这个数据存入new_user表*/
            $access_token = Wechat::get_access_token();
            /*获取用户个人详细信息*/
            $url = 'https://api.weixin.qq.com/cgi-bin/user/info?access_token='.$access_token['access_token'].'&openid='.$openid.'&lang=zh_CN';
            $userinfo = Wechat::curl($url);

            $flight = new NewUser();
            $flight->openid = $openid;
            $flight->type = 0;
            $flight->voucher = 0;
            $flight->nickname = $userinfo['nickname'];
            $flight->headimg = $userinfo['headimgurl'];
            $flight->worker_id = 0;
            $flight->save();
    	}

    	$parentObj = NewUser::where('openid', $openid)->first();

    	$uid = $parentObj->id;

    	$contentArr = ContactChat::where('contact_chat.uid', $uid)
    		->where('contact_chat.status', 1)
    		->orderBy('contact_chat.created_at', 'desc')
    		->limit(10)
    		->leftJoin('new_user as nu', 'nu.id', 'contact_chat.uid')
    		// ->leftJoin('admin_info as ai', 'ai.id', 'contact_chat.admin_id')
    		->select('contact_chat.*', 'nu.headimg as uheadimg')
    		->get()
    		->toArray();

    	krsort($contentArr);

        foreach ($contentArr as $key => $value) {
            if ($value['admin_id'] != 0) {
                $kk = $value['admin_id'];
                $contentArr[$key]['aheadimg'] = NewUser::find($kk)->headimg;
            }
        }

    	/*查聊天记录*/
    	return view('front.views.parent.chat', ['parentObj'=>$parentObj,'content'=>$contentArr,'uid'=>$uid]);
    }

    /*获取之前的几条数据*/
    public function getPrevMessage(Request $request) {
        $time = $request->input('time');
        $uid = $request->input('uid');
        $contentArr = ContactChat::where('contact_chat.uid', $uid)
            ->where('contact_chat.status', 1)
            ->where('contact_chat.created_at', '<', $time)
            ->orderBy('contact_chat.created_at', 'desc')
            ->limit(5)
            ->leftJoin('new_user as nu', 'nu.id', 'contact_chat.uid')
            // ->leftJoin('parent_info as pi', 'pi.id', 'contact_chat.uid')
            // ->leftJoin('admin_info as ai', 'ai.id', 'contact_chat.admin_id')
            // ->select('contact_chat.*', 'nu.headimg as uheadimg', 'ai.headimg as aheadimg')
            ->select('contact_chat.*', 'nu.headimg as uheadimg')
            ->get()
            ->toArray();

            foreach ($contentArr as $key => $value) {
                $kk = $value['admin_id'];
                if ($kk) {
                    $contentArr[$key]['aheadimg'] = NewUser::find($kk)->headimg;
                }
                $contentArr[$key]['content'] = $this->emoji_decode($value['content']);
            }

        return response()->json(['errcode'=>0,'content'=>$contentArr]);
    }

    private function emoji_decode($str)
    {   
        $strDecode = preg_replace_callback('|\[\[EMOJI:(.*?)\]\]|', function($matches){  
            return rawurldecode($matches[1]);
        }, $str);

        return $strDecode;
    }

    public function oauth()
    {
        if (Session::has('openid')) {
            return redirect('/front/parent/parentChat');
        } else {
            return redirect(OauthController::getUrl(11, 1));
        }
    }
}
