<?php

namespace App\Http\Controllers\MyChat;

use App\Models\MyChatGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class MyGroupController extends Controller
{
    public function makeGroup(){
       return view('mychat.group.make-group');
    }

    public function makeGroupSubmit(Request $request){

        $this->validate($request, [
            'name' => 'required|unique:my_chat_groups',
            'code' => 'required|unique:my_chat_groups',
        ]);

        try {
            DB::beginTransaction();
            $data = collect($request->all())->except('_token')->toArray();
            $data['user_id'] = auth()->user()->id;
            // dd($data);
            $group = MyChatGroup::create($data);

            $group->mychatUsers()->attach([auth()->user()->id]);
            DB::commit();
            record_created_flash('Group created successfully');

        } catch (\Exception $e) {
            DB::rollBack();
            something_wrong_flash($e->getMessage());

            //throw $th;
        }
        return redirect()->back();

    }
}
