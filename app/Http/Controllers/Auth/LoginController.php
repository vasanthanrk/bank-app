<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{
    public function index(){
        $user = Auth::user();
        if($user != null){
            return redirect()->route('dashboard');
        }
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);
 
        $user = DB::table('users')->where(['email' => $request->input('email')])->first();
        $remember = $request->input('remember')??'0';
        if($user != null){
            if(Auth::attempt(['email' => $request->input('email'),  'password' => $request->input('password')],$remember)){
                return redirect()->route('dashboard')->with('success','You are Logged in sucessfully.');
            }else {
                return back()->with('error','Whoops! invalid email and password.');
            }
        }else{
            return back()->with('error','Whoops! invalid email and password.');
        }
        
    }
 
    public function logout(Request $request)
    {
        Auth::logout();
        Session::flush();
        return redirect(route('login'))->with('success','You are logout sucessfully.');
    }
}
