@extends('layouts.app')

@section('content')
    {!! Form::open(['route' => ['changeStatus', Auth::user()->id],'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
    <div class="px-2 py-5 my-5 text-center">
        <h1 class="display-5 fw-bold">@if($customer->is_member){{ __('Member Deactivation') }}@else{{__('Member Activation')}}@endif</h1>
        <div class="col-lg-4 mx-auto">
            @if($customer->is_member)
                <p class="lead mb-4">Upon deactivating membership, you will lose some of these perks:</p>
                <ul>
                    <li>You will not receive notification regarding vouchers or promotion that OCS is having</li>
                </ul>
                <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
                    <input name="is_member" value="{{$customer->is_member = 0}}" type="hidden">
                    {{ Form::submit('Deactivate Membership', ['class' => 'btn btn-danger']) }}
                </div>
            @else
                <p class="lead mb-4">Upon activating membership, you will get some of these perks:</p>
                <ul>
                    <li>You will receive notification regarding vouchers or promotion that OCS is having</li>
                </ul>
                <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
                    <input name="is_member" value="{{$customer->is_member = 1}}" type="hidden">
                    {{ Form::submit('Activate Membership', ['class' => 'btn btn-success']) }}
                </div>
            @endif
        </div>
    </div>
    {!! Form::close() !!}

@endsection
