<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DropzoneController extends Controller
{
    public function list(){
        return view('drop_zone.list');
    }
    public function index(){
        return view('drop_zone.index');
    }
}
