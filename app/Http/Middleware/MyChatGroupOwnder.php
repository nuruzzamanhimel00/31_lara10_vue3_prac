<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\MyChatGroup;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MyChatGroupOwnder
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $group = MyChatGroup::query()->find($request->gId);
        if($group->user_id == auth()->user()->id){
            return $next($request);
        }
        something_wrong_flash('Unauthorized access');
        return redirect()->back();
    }
}
