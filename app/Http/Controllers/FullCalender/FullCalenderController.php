<?php

namespace App\Http\Controllers\FullCalender;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FullCalenderController extends Controller
{
    public function index(){
       return view('full_calender.fclander-index');
    }
}
