<?php

namespace App\Http\Controllers\Primevue;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class PrimevueController extends Controller
{
    public function getUsers(Request $request)
    {
        if($request->ajax()){
            $users = User::paginate(50);
            return response()->json($users);
        }
        return view('prime-vue.index');
    }
}
