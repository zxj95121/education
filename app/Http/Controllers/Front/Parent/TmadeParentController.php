<?php

namespace App\Http\Controllers\Front\Parent;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\NewUser;
use App\Models\TmadeParent;
use App\Models\TmadeParentSession;

use Session;

class TmadeParentController extends Controller
{
    public function submit(Request $request)
    {
        $subject = $request->input('subject');
        $price = $request->input('price');
        $time = $request->input('time');
        $education = $request->input('education');
        $hobby = $request->input('hobby');
        $type = $request->input('type');
        $exp = $request->input('exp');
        $sex = $request->input('sex');
    }
    
    public function session(Request $request)
    {
        $openid = Session::get('openid');
        $uid = NewUser::where('openid', $openid)
            ->select('id')
            ->get()[0]
            ->id;
        
        $data = $request->all();
        
        $count = TmadeParentSession::where('status', 1)
            ->count();
        
        if ($count > 0) {
            TmadeParentSession::where('status', 1)
                ->where('uid', $uid)
                ->update($data);
        } else {
            $flight = new TmadeParentSession();
            $flight->uid = $uid;
            foreach ($data as $key => $value) {
                $flight->$key = $value;
            }
            $flight->save();
        }
        
        return response()->json(['errcode'=>0]);
        
        
//         $subject = $request->input('subject');
//         $price = $request->input('price');
//         $time = $request->input('time');
//         $education = $request->input('education');
//         $hobby = $request->input('hobby');
//         $type = $request->input('type');
//         $exp = $request->input('exp');
//         $sex = $request->input('sex');
    }
}
