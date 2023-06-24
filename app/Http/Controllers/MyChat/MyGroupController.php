<?php

namespace App\Http\Controllers\MyChat;

use App\Models\User;
use App\Models\MyChat;
use App\Models\MyChatGroup;
use Illuminate\Http\Request;
use App\Events\SendMessageEvent;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class MyGroupController extends Controller
{
    public function __construct()
    {
        $this->middleware('myChatGroupOwnder')->only(['groupMemberList','groupMemberDelete']);
    }

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

    public function makeGroupList(){
        $groups = MyChatGroup::with(['user'])->latest()->get();
        return view('mychat.group.group-list', compact('groups'));
    }

    public function makeGroupJoin(Request $request){
        $this->validate($request, [
            'code' => 'required',
        ]);
        $group = MyChatGroup::where('code', $request->code)->where('id',$request->group_id)->first();
        if(!is_null($group)){
            try {
                DB::beginTransaction();
                $group->mychatUsers()->attach(auth()->user()->id);
                DB::commit();
                record_created_flash('Group Join successfully');

            } catch (\Exception $e) {
                DB::rollBack();
                something_wrong_flash('You are already a member of this group');

                //throw $th;
            }


        }else{
            something_wrong_flash('Group not found');
        }
        return redirect()->back();

        // dd($request->all());
    }

    public function groupMemberList($gId){
        $group = MyChatGroup::query()->with(['mychatUsers'])->find($gId);
        return view('mychat.group.group-members',compact('group'));
    }

    public function groupMemberDelete($gId,  $uId){
        $group = MyChatGroup::query()->with(['mychatUsers'])->find($gId);
        $user = User::find($uId);
        if($user->id === auth()->user()->id){
            something_wrong_flash('Ownder Cannot Delete');
            return redirect()->back();
        }
        $group->mychatUsers()->detach($user->id);
        record_created_flash('Member deleted successfully');
        return redirect()->back();
    }

    public function groupChat($gId){
        $group= MyChatGroup::find($gId);
        return view('mychat.group.group-chats',compact('group'));
    }

    public function groupAllMessages($gId){
        $chats = MyChat::where('group_id', $gId)->latest()->get();
        return response()->json($chats);
    }

    public function groupSendMessage(Request $request, $gId){
        // dd($request->all());
        $this->validate($request, [
            'message' => 'required',
        ]);
        $chat = MyChat::create([
            'message' => $request->message,
            'group_id' => $gId,
            'user_id' => $request->user_id,
        ]);
        $chat = $chat->load('user','group');
        broadcast(new SendMessageEvent($chat))->toOthers();
        return response()->json($chat);
        // dd($gId, $request->all());
    }

}
