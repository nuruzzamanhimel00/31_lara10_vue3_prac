<?php

namespace App\Http\Controllers\MyChat;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MyChatController extends Controller
{
    public function dashboard(){
        return view('mychat.dashboard');
    }
}
