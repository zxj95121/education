<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\ContactChat;

class ChatController extends Controller
{
    public function chatShow(Request $request)
    {
    	return view('admin.chat.chatShow');
    }
}
