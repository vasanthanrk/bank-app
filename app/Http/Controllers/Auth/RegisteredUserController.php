<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $user_data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'min:8'],
            'terms_and_policy' => ['required'],
        ]);
        try{
        
            DB::transaction(function() use($user_data){
                $user_data['password'] = Hash::make($user_data['password']);
                User::create($user_data);
            });

            return redirect()->route('login')->with('success', 'Thank you for registering with us!');
        }
        catch  (\Exception $e) {
            return redirect()->route('register')->with('error', 'Something went wrong please try again!');
        }
    }

    public function rand_num(){
        $school_id = random_int(100000, 999999);
        $school_detail = DB::table('school_details')->where(['school_id' => $school_id])->first();
        if($school_detail != null){
            $this->rand_num();
        }
        return $school_id;
    }
}
