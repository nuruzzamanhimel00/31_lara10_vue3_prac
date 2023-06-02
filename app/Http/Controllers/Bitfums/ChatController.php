<?php

namespace App\Http\Controllers\Bitfums;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function index(){
        return view('pages.realchats.index');
    }

    public function bitfumsIndex(){
        return view('pages.realchats.bitfums.index');
    }
}
