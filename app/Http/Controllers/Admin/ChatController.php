<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\ContactChat;

use Session;

class ChatController extends Controller
{
    public function chatShow(Request $request)
    {
    	$chatUser = ContactChat::where('contact_chat.status', '1')
    		->leftJoin('parent_info as pi', 'pi.id', 'contact_chat.uid')
    		->leftJoin('parent_detail as pd', 'pd.pid', 'pi.id')
    		->select('pi.id', 'pi.phone', 'pi.name as nickname', 'pd.name as name')
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
    	return view('admin.chat.chatShow', ['chatUser'=>$chatUser,'numArr'=>$numArr]);
    }

    public function chatting(Request $request)
    {
    	$uid = $request->input('uid');
    	$admin_id = Session::get('admin_id');

    	$contentArr = ContactChat::where('contact_chat.uid', $uid)
    		->where('contact_chat.status', 1)
    		->orderBy('contact_chat.created_at', 'desc')
    		->limit(10)
    		->leftJoin('parent_info as pi', 'pi.id', 'contact_chat.uid')
    		->select('contact_chat.*', 'pi.headimg')
    		->get()
    		->toArray();

    	// $content = array();
    	// $num = count($contentArr)-1;
    	// foreach ($contentArr as $value) {
    	// 	$content[$num--] = $value;
    	// }

    	return view('admin.chat.chatting', ['content'=>$contentArr,'admin_id'=>$admin_id,'user_id'=>$uid]);
    }
}
