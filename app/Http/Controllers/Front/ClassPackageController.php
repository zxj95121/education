<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\ClassPackage;

class ClassPackageController extends Controller
{
    public function index(Request $request)
    {
    	$id = $request->input('id', '');
    	if (!$id) {
    		/*没有带id参数*/
    		return redirect('/front/error403');
    	}

    	$package = ClassPackage::find($id);

    	return view('front.views.classPackage.show');
    }
}
