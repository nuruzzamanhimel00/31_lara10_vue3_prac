<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Group;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Auth;

class GroupMember
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $grpup = Group::find($request->id);

        $group_members = $grpup->participants;
        $join_group_members = [];
        foreach($group_members as $group_member){
            $join_group_members[] = $group_member->user_id;
        }

        if(in_array(Auth::id(), $join_group_members)){
            return $next($request);
        }
       return route('/');
    }
}
