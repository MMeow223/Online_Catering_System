@extends('layouts.app')

@section('content')

    <div class="container">
        <h1>Create Notification</h1>
        <h4>Choose a notification to create:</h4>
        <div class="row justify-content-center p-3">
                <a href="{{ route('createPromo') }}"
                   class="btn btn-primary float-right m-5 p-5 w-50"><h1>{{ __('Create Promotion') }}</h1></a>

        </div>
        <div class="row justify-content-center p-3">

            <a href="{{ route('createVoucher') }}"
               class="btn btn-primary float-right m-5 p-5 w-50"><h1>{{ __('Create Voucher') }}</h1></a>
        </div>
    </div>


@endsection
