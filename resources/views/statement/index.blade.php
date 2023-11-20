@extends('layouts.app')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Dashboard /</span> Statement</h4>
    @if(!empty(session('success')))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if(!empty(session('error')))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    <div class="card">
        <h5 class="card-header">Statement Of Account</h5>
        
        <div class="card-body">
            <div class="table-responsive text-nowrap" style="height: 400px;">
                <table class="table" id="example1">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Date TIme</th>
                            <th>Amount</th>
                            <th>Type</th>
                            <th>Details</th>
                            <th>Balance</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($transactions as $transaction)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ date('d-m-Y h:i A', strtotime($transaction->transaction_date)) }}</td>
                            <td>{{ $transaction->amount }}</td>
                            <td>{{ ucwords($transaction->transaction_mode) }}</td>
                            <td>
                                @php
                                    if($transaction->transaction_type == 'transfer'){
                                        if($transaction->transaction_mode == 'credit'){
                                            echo 'Transfer from '.$transaction->transaction_account->email;
                                        }elseif($transaction->transaction_mode == 'debit'){
                                            echo 'Transfer to '.$transaction->transaction_account->email;
                                        }
                                    }else{
                                        echo ucfirst($transaction->transaction_type);
                                    }
                                @endphp
                            </td>
                            <td>{{ $transaction->balance }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{ $transactions->appends($_GET)->links() }}
        </div>
    </div>
</div>
@endsection