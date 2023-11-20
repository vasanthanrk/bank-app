@extends('layouts.app')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Dashboard /</span> Transfer</h4>
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
    <div class="col-lg-6 col-md-12 col-6 mb-4">
        <div class="card">
            <h5 class="card-header">Transfer</h5>
            <div class="card-body">
                <form method="POST" action="{{ route('transfer.post') }}">
                    @csrf
                    <div class="col-lg-12 col-md-4 order-1 appent_row">
                        <div class="row row_inputs">
                            <div class="col-lg-12 col-md-12 col-6 mb-4">
                                <div class="mb-3">
                                    <label class="form-label">Email Address *</label>
                                    <input type="text" class="form-control" name="email" value="{{ old('email') }}" placeholder="Enter Email">
                                    @error('email')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row row_inputs">
                            <div class="col-lg-12 col-md-12 col-6 mb-4">
                                <div class="mb-3">
                                    <label class="form-label">Amount *</label>
                                    <input type="text" class="form-control" name="amount" value="{{ old('amount') }}" placeholder="Enter amount to transfer">
                                    @error('amount')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row row_inputs">
                            <div class="col-lg-12 col-md-12 col-6 mb-4">
                                <div class="mb-3">
                                    <label class="form-label">Description </label>
                                    <textarea type="text" class="form-control" name="description"></textarea>
                                    @error('description')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 col-md-12 col-6 mb-4">
                                <div class="mt-4">
                                    <button type="submit" class="btn btn-primary">Transfer</button>
                                </div>
                            </div>
                            <div class="d-flex justify-content-end col-lg-6 col-md-12 col-6 mb-4">
                                <div class="mt-4">
                                    <a href="{{ route('dashboard') }}" class="btn btn-warning">Dashboard</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection