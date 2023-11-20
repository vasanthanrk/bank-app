<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StatementController extends Controller
{
    public function index(){
        $user = Auth::user();
        $transactions = Transaction::where(['account_id' => $user->id])->orderBy('id', 'ASC')->paginate(10);
        return view('statement.index', compact('transactions'));
    }
}
