<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\ContactChat;
use App\Models\ParentInfo;
use App\Models\ParentDetail;

use Session;

class ChatController extends Controller
{
    public function chatShow(Request $request)
    {
    	$read = $request->input('read');

    	$chatUser = ContactChat::where('contact_chat.status', '1')
    		->leftJoin('parent_info as pi', 'pi.id', 'contact_chat.uid')
    		->leftJoin('parent_detail as pd', 'pd.pid', 'pi.id');

    	if ($read != '1') {
    		$chatUser = $chatUser->where('contact_chat.read', '0');
    	} else {
    		$read = '1';
    	}

    	$chatUser = $chatUser->select('pi.id', 'pi.phone', 'pi.name as nickname', 'pd.name as name')
    		->groupBy('uid')
    		->paginate(15);

    	$numArr = array();
    	foreach ($chatUser as $key => $value) {
    		$unRead = ContactChat::where('status', '1')
    			->where('uid', $value['id'])
    			->where('read', '0')
    			->count();
    		$numArr[$key]= $unRead;
    	}
    	// dd($chatUser->toArray());
    	return view('admin.chat.chatShow', ['chatUser'=>$chatUser,'numArr'=>$numArr,'read'=>$read]);
    }

    public function chatting(Request $request)
    {
    	$uid = $request->input('uid');
    	$admin_id = Session::get('admin_id');

    	/*将所有未读消息清空*/
    	ContactChat::where('status', '1')
    		->where('uid', $uid)
    		->where('read', '0')
    		->update(['read'=>'1']);

    	$contentArr = ContactChat::where('contact_chat.uid', $uid)
    		->where('contact_chat.status', 1)
    		->orderBy('contact_chat.created_at', 'desc')
    		->limit(10)
    		->leftJoin('parent_info as pi', 'pi.id', 'contact_chat.uid')
    		->leftJoin('admin_info as ai', 'ai.id', 'contact_chat.admin_id')
    		->select('contact_chat.*', 'pi.headimg as uheadimg', 'ai.headimg as aheadimg')
    		->get()
    		->toArray();

    	// $content = array();
    	// $num = count($contentArr)-1;
    	// foreach ($contentArr as $value) {
    	// 	$content[$num--] = $value;
    	// }
    	krsort($contentArr);

    	/*查用户姓名*/
    	$userInfo = ParentInfo::where('parent_info.id', $uid)
    		->leftJoin('parent_detail as pd', 'pd.pid', 'parent_info.id')
    		->select('pd.name as name', 'parent_info.headimg as headimg')
    		->get()[0];

    	return view('admin.chat.chatting', ['content'=>$contentArr,'admin_id'=>$admin_id,'user_id'=>$uid,'userInfo'=>$userInfo]);
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
    		->leftJoin('parent_info as pi', 'pi.id', 'contact_chat.uid')
    		->leftJoin('admin_info as ai', 'ai.id', 'contact_chat.admin_id')
    		->select('contact_chat.*', 'pi.headimg as uheadimg', 'ai.headimg as aheadimg')
    		->get()
    		->toArray();

    	return response()->json(['errcode'=>0,'content'=>$contentArr]);
    }
}
