<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TransferController extends Controller
{
    public function index(){
        return view('transfer.index');
    }

    public function transfer(Request $request){
        $data = $request->validate([
            'email' => ['required', 'string', 'email', 'max:255'],
            'amount' => ['required', 'numeric', 'min:0.01'],
            'description' => ['max:255']
        ]);

        try{
            $user = Auth::user();
            if($user->email == $data['email']){
                return redirect()->back()->with('error', 'Self account tansfer is not possible.!');
            }

            $to_user = DB::table('users')->where(['email' => $data['email']])->first();
            if($to_user == null){
                return redirect()->back()->with('error', 'Sorry system cannot find account to transfer amount.!');
            }

            // Get the account last transaction details
            $from_account = DB::table('transactions')->where(['account_id' => $user->id])->orderBy('id', 'DESC')->first();
            $to_account = DB::table('transactions')->where(['account_id' => $to_user->id])->orderBy('id', 'DESC')->first();
            $from_blc = $from_account->balance??0;
            $to_blc = $to_account->balance??0;

            if($from_blc > $data['amount']){
                
                // calculate the account balance
                $fromNewBalance = $from_blc - $data['amount'];
                $toNewBalance = $to_blc + $data['amount'];

                $from_data = [
                    'account_id' => $user->id,
                    't_account_id' => $to_user->id,
                    'transaction_type' => 'transfer',
                    'transaction_mode' => 'debit',
                    'amount' => $data['amount'],
                    'balance' => $fromNewBalance,
                    'description'  => $data['description'],
                ];
                $to_data = [
                    'account_id' => $to_user->id,
                    't_account_id' => $user->id,
                    'transaction_type' => 'transfer',
                    'transaction_mode' => 'credit',
                    'amount' => $data['amount'],
                    'balance' => $toNewBalance,
                    'description'  => $data['description'],
                ];

                DB::transaction(function() use($from_data, $to_data){
                    
                    // Make entry FROM transaction details
                    $from_trans_id = DB::table('transactions')->insertGetId($from_data);
                    $to_data['reference_number'] = $from_trans_id;

                    // Make entry TO transaction details
                    $to_trans_id = DB::table('transactions')->insertGetId($to_data);
                    DB::table('transactions')->where(['id' => $from_trans_id])->update(['reference_number' => $to_trans_id]);
                });
                return redirect()->back()->with('success', 'Amount Transfer successful.!');
            }

            return redirect()->back()->with('error', 'Insufficient funds to transfer amount.!');
        }
        catch  (\Exception $e) {
            return redirect()->route('register')->with('error', 'Something went wrong please try again!');
        }
    }
}
