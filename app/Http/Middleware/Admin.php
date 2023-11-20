<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Admin
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();
        if($user != null){
            return $next($request);
        }
        
        Auth::logout();
        if($request->ajax()){
            return response()->json(['status' => 1, 'msg' => 'You do not have permission to access for this page.']);
        }
        return redirect()->route('login');
    }
}
