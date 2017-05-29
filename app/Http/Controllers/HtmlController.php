<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HtmlController extends Controller
{
    public function index(Request $request)
    {
    	// $res = explode('/', $_SERVER['REQUEST_URI'])[2];
    	// echo $res;
    	$res = $request->input('res');
    	$views = $this->$res();
    	return view($views);
    }

    private function register(){
    	return 'front.views.index';
    }
}
