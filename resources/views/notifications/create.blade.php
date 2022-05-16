@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <a href="{{ route('createPromo') }}"
               class="btn btn-primary float-right">{{ __('Create Promotion') }}</a>
        </div>
        <div class="row justify-content-center">
            <a href="{{ route('createVoucher') }}"
               class="btn btn-primary float-right">{{ __('Create Voucher') }}</a>
        </div>
    </div>


@endsection
