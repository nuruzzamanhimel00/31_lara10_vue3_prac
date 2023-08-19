<?php

namespace App\Http\Controllers\FullCalender;

use App\Http\Controllers\Controller;
use App\Http\Resources\BookingResource;
use App\Models\Booking;
use Illuminate\Http\Request;

class FullCalenderController extends Controller
{
    public function index(){
       return view('full_calender.fclander-index');
    }

    public function laravel(){
        $events= BookingResource::collection(Booking::all());
        return view('full_calender.fclander-laravel', compact('events'));
    }
    public function bookingStore(Request $request){

        $validated = $request->validate([
            'title' => 'required|max:255',
        ]);
        $booking = Booking::create($request->all());
        return response()->json([
            'status'=> 'success',
            'data' => $booking
        ]);
        // dd($request->all());
    }

    public function bookingUpdate(Request $request, $id){
        $booking = Booking::updateOrCreate(
            ['id' => $id],
            $request->all()
        );
        return response()->json([
            'status'=> 'success',
            'data' => $booking
        ]);
        // dd($request->all(), $id);
    }

    public function bookingDelete($id){
        $booking = Booking::find($id);
        if($booking->delete()){
            return response()->json([
                'status'=> 'success',
            ]);
        }

    }
}
