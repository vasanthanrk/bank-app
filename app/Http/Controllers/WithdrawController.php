<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class WithdrawController extends Controller
{
    public function index(){
        return view('withdraw.index');
    }

    public function withdraw(Request $request){
        $data = $request->validate([
            'amount' => 'required|numeric|min:0.01',
            'description' => 'max:255'
        ]);

        $user = Auth::id();

        // Retrieve the last transaction details
        $account = DB::table('transactions')->where(['account_id' => $user])->orderBy('id', 'DESC')->first();
        $blc = 0;
        if($account != null){
            $blc = $account->balance;
        }

        if($blc > $data['amount']){
            // Update the account balance
            $newBalance = $blc - $data['amount'];

            DB::table('transactions')->insert([
                'account_id' => $user,
                't_account_id' => $user,
                'transaction_type' => 'withdrawal',
                'transaction_mode' => 'debit',
                'amount' => $data['amount'],
                'balance' => $newBalance,
                'description'  => $data['description'],
            ]);

            return redirect()->back()->with('success', 'Withdraw successful.!');
        }
        return redirect()->back()->with('error', 'Insufficient funds to withdraw.!');
    }
}
