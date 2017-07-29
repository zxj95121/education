<?php

namespace App\Http\Controllers\Front\Parent;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\ParentInfo;

use Session;

class ChatController extends Controller
{
    public function home()
    {
    	$openid = Session::get('openid');
    	$count = ParentInfo::where('openid', $openid)->count();
    	if ($count == 0) {
    		return redirect('/front/error_403');
    	}
    	$parentObj = ParentInfo::where('openid', $openid)->first();

    	$uid = $parentObj->id;

    	$contentArr = ContactChat::where('contact_chat.uid', $uid)
    		->where('contact_chat.status', 1)
    		->orderBy('contact_chat.created_at', 'desc')
    		->limit(10)
    		->leftJoin('parent_info as pi', 'pi.id', 'contact_chat.uid')
    		->leftJoin('admin_info as ai', 'ai.id', 'contact_chat.admin_id')
    		->select('contact_chat.*', 'pi.headimg as uheadimg', 'ai.headimg as aheadimg')
    		->get()
    		->toArray();

    	krsort($contentArr);

    	/*查聊天记录*/
    	return view('front.views.parent.chat', ['parentObj'=>$parentObj,'content'=>$contentArr]);
    }
}
