@extends('layouts.app')

@section('content')

<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <div class="col-lg-12 col-md-4 order-1">
            <div class="row">
                <div class="col-lg-6 col-md-12 col-6 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h3>Welcome {{$user->name}}</h3>
                            <hr>
                            <span>User Id:{{$user->email }}</span>
                            <hr>
                            <span>Your Balance: {{$blc}} INR</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection