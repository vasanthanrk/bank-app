<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(){
        $user = Auth::user();
        $transaction = DB::table('transactions')->where(['account_id' => $user->id])->orderBy('id', 'DESC')->first();
        $blc = 0.00;
        if($transaction != null){
            $blc = $transaction->balance;
        }
        return view('dashboard',compact('user','blc'));
    }
}
