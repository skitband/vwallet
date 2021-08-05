@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Account Dashboard</div>

                <div class="card-body">
                    @if(!empty($message))
                        <div class="alert alert-success"> {{ $message }}</div>
                    @endif
                    <a href="{{route('wallet.create')}}" class="btn btn-outline-primary">Create Wallet</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
