@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <create-transaction-component :wallet-id="{{ $walletId }}"/>
    </div>
</div>
@endsection