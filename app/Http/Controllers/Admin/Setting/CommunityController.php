<?php

namespace App\Http\Controllers\Admin\Setting;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\CommunityArea;
use App\Models\CommunityCity;
use App\Models\CommunityCommunity;

class CommunityController extends Controller
{
    public function communityManage()
    {
    	/*找出所有的一级分类*/
    	$cityInfo = CommunityCity::where('status', '1')
    		->get();
    	return view('admin.os.communityManage',['cityInfo'=>$cityInfo]);
    }

    /*请求所有的数据*/
    public function getAll(Request $request)
    {
    	$cityInfo = CommunityCity::where('status', '1')
    		->select('id', 'name')
    		->get();

    	/*区县数组*/
    	$areaInfo = CommunityArea::where('status', '1')
    		->select('id', 'name', 'cid')
    		->get()
    		->toArray();
    	$areaArr = array();
    	foreach ($areaInfo as $value) {
    		$areaArr[$value['cid']][] = array('did'=>$value['id'], 'name'=>$value['name']);
    	}

    	/*社区数组*/
    	$communityInfo = CommunityCommunity::where('status', '1')
    		->select('id', 'name', 'aid')
    		->get()
    		->toArray();
    	$communityArr = array();
    	foreach ($communityInfo as $value) {
    		$communityArr[$value['aid']][] = array('did'=>$value['id'], 'name'=>$value['name']);
    	}

    	return response()->json(['area'=>$areaArr, 'community'=>$communityArr]);
    }

    public function cityAdd(Request $request)
    {
    	$name = $request->input('val');
    	$flight = new CommunityCity();
    	$flight->name = $name;
    	$flight->save();
    	return response()->json(['errcode'=>0,'id'=>$flight->id]);
    }

    public function areaAdd(Request $request)
    {
    	$name = $request->input('val');
    	$cid = $request->input('cid');

    	$flight = new CommunityArea();
    	$flight->name = $name;
    	$flight->cid = $cid;
    	$flight->save();
    	return response()->json(['errcode'=>0,'id'=>$flight->id]);
    }

    public function communityAdd(Request $request)
    {
		$name = $request->input('val');
    	$aid = $request->input('aid');

    	$flight = new CommunityCommunity();
    	$flight->name = $name;
    	$flight->aid = $aid;
    	$flight->save();
    	return response()->json(['errcode'=>0,'id'=>$flight->id]);
    }

    /*修改内容*/
    public function editName(Request $request)
    {
    	$name = $request->input('value');
    	$type = $request->input('type');
    	$id = $request->input('id');

    	switch ($type) {
    		case 'type_city':
    			$flight = CommunityCity::find($id);
    			break;
    		case 'type_area':
    			$flight = CommunityArea::find($id);
    			break;
    		case 'type_community':
    			$flight = CommunityCommunity::find($id);
    			break;
    	}

    	$flight->name = $name;
    	$flight->save();

    	/*区县数组*/
    	$areaInfo = CommunityArea::where('status', '1')
    		->select('id', 'name', 'cid')
    		->get()
    		->toArray();
    	$areaArr = array();
    	foreach ($areaInfo as $value) {
    		$areaArr[$value['cid']][] = array('did'=>$value['id'], 'name'=>$value['name']);
    	}

    	/*社区数组*/
    	$communityInfo = CommunityCommunity::where('status', '1')
    		->select('id', 'name', 'aid')
    		->get()
    		->toArray();
    	$communityArr = array();
    	foreach ($communityInfo as $value) {
    		$communityArr[$value['aid']][] = array('did'=>$value['id'], 'name'=>$value['name']);
    	}

    	return response()->json(['errcode'=>0,'area'=>$areaArr, 'community'=>$communityArr]);
    }

    /*删除内容*/
    public function communityDelete(Request $request)
    {
    	$type = $request->input('type');
    	$id = $request->input('id');

    	switch ($type) {
    		case 'type_city':
    			$flight = CommunityCity::find($id);
    			$flight->status = '0';
    			$flight->save();

    			$aidObj = CommunityArea::where('cid', $id)
    				->select('id')
    				->get();
    			if ($aidObj->count() > 0) {
    				/*如果他有二级菜单*/
    				foreach ($aidObj as $value) {
    					$aid = $value->id;
    					CommunityCommunity::where('aid', $aid)
    						->update(['status'=>0]);
    					CommunityArea::where('id', $aid)
    						->update(['status'=>'0']);
    				}
    			}
    			break;
    		case 'type_area':
    			$flight = CommunityArea::find($id);
    			$flight->status = '0';
    			$flight->save();

    			CommunityCommunity::where('aid', $id)
    				->update(['status'=>0]);
    			break;
    		case 'type_community':
    			$flight = CommunityCommunity::find($id);
    			$flight->status = '0';
    			$flight->save();
    			break;
    	}

    	/*区县数组*/
    	$areaInfo = CommunityArea::where('status', '1')
    		->select('id', 'name', 'cid')
    		->get()
    		->toArray();
    	$areaArr = array();
    	foreach ($areaInfo as $value) {
    		$areaArr[$value['cid']][] = array('did'=>$value['id'], 'name'=>$value['name']);
    	}

    	/*社区数组*/
    	$communityInfo = CommunityCommunity::where('status', '1')
    		->select('id', 'name', 'aid')
    		->get()
    		->toArray();
    	$communityArr = array();
    	foreach ($communityInfo as $value) {
    		$communityArr[$value['aid']][] = array('did'=>$value['id'], 'name'=>$value['name']);
    	}

    	return response()->json(['errcode'=>0,'area'=>$areaArr, 'community'=>$communityArr]);
    }
}
