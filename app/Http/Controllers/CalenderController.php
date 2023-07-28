<?php

namespace App\Http\Controllers;

use App\Models\Calender;
use Illuminate\Http\Request;
use App\Http\Resources\CalenderResource;
use Symfony\Component\HttpFoundation\Response;

class CalenderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function list()
    {
       return view('full_calender.list');
    }

    public function fullCalenderIndex(){
        return view('full_calender.index');
    }

    public function index(){
        // return UserResource::collection(User::all());
        // return new CalenderResource(Calender::findOrFail(1));
        return CalenderResource::collection(Calender::all());
        dd('dd');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $new_calendar = Calender::create($request->all());
        return response()->json([
            'data' => new CalenderResource($new_calendar),
            'message' => 'Successfully added new event!',
            'status' => Response::HTTP_CREATED
        ]);
    }

    /**
     * Display the specified resource.
     */

    public function show(Calender $calendar)
    {
        return response($calendar, Response::HTTP_OK);
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Calender $calender)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $calendar)
    {
        $calendar_data = Calender::where('id', $calendar)->first();
        $calendar_data->update($request->all());
        return response()->json([
            'data' => new CalenderResource($calendar_data),
            'message' => 'Successfully updated event!',
            'status' => Response::HTTP_ACCEPTED
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($calendar)
    {
        // dd($calendar);
        $calendar_data = Calender::where('id', $calendar)->delete();
        // dd($calendar);

        return response()->json([
            'message' =>'Event removed successfully!',
        ]);


    }
}
