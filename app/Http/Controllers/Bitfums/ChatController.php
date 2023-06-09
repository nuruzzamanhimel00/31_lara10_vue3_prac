<?php

namespace App\Http\Controllers\Bitfums;

use App\Models\User;
use App\Events\ChatEvent;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function index(){
        return view('pages.realchats.index');
    }

    public function bitfumsIndex(){
        // dd(auth()->id());
        return view('pages.realchats.bitfums.index');
    }

    public function bitfumSendMessage(Request $request){
        // dd($request->all());
        $user = User::find( Auth::user()->id);

        event(new ChatEvent($request->message, $user));
    }
}
