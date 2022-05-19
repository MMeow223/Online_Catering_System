@extends('layouts.app')

@section('content')
    {!! Form::open(['route' => ['changeStatus',Auth::user()->id],'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
    <div class="px-2 py-5 my-5 text-center">
        <h1 class="display-5 fw-bold">@if($customer->is_member && $customer->is_subscribed ==0){{__('Member Reactivation')}}@elseif($customer->is_member){{ __('Member Deactivation') }}@else{{__('Member Activation')}}@endif</h1>
        <fieldset class="col-lg-4 mx-auto">
        @if($customer->is_member && $customer->is_subscribed ==0)
            <p class="lead mb-4">By reactivating membership, you will gain back some of these perks:</p>
            <ul>
                <li>You will receive notification regarding vouchers or promotion that OCS is having</li>
            </ul>

            <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
                <input name="expiry_date" value="{{ $customer->expiry_date }}" type="hidden">
                <input name="is_subscribed" value="{{ $customer->is_subscribed = 1 }}" type="hidden">
                <input name="is_member" value="{{ $customer->is_member = 1 }}" type="hidden">
                {{ Form::submit('Reactivate Membership', ['class' => 'btn btn-success'], url('/membership')) }}
            </div>
        @elseif($customer->is_member)
            <p class="lead mb-4">Upon deactivating membership, you will lose some of these perks:</p>
            <ul>
                <li>You will not receive notification regarding vouchers or promotion that OCS is having</li>
            </ul>

            <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
                <input name="expiry_date" value="{{ $customer->expiry_date }}" type="hidden">
                <input name="is_subscribed" value="{{ $customer->is_subscribed = 0 }}" type="hidden">
                <input name="is_member" value="{{ $customer->is_member = 1 }}" type="hidden">
                {{ Form::submit('Deactivate Membership', ['class' => 'btn btn-danger']) }}
            </div>

        @else
            <p class="lead mb-4">Upon activating membership, you will get some of these perks:</p>
            <ul>
                <li>You will receive notification regarding vouchers or promotion that OCS is having</li>
            </ul>
            <div class="row mx-auto py-3">
                <div class="col">
                    <input class=" fs-6" type="radio" name="expiry_date" id="duration-radio-month" value="{{$customer->expiry_date=now()->addDays(30)}}">
                    <label class="fs-6" for="duration-radio-month">
                        {{__('1 Month')}}
                    </label>
                </div>
                <div class="col">
                    <input class=" fs-6" type="radio" name="expiry_date" id="duration-radio-6month" value="{{$customer->expiry_date=now()->addDays(180)}}">
                    <label class="fs-6" for="duration-radio-6month">
                        {{__('6 Month')}}
                    </label>
                </div>
                <div class="col">
                    <input class="fs-6" type="radio" name="expiry_date" id="duration-radio-year" value="{{$customer->expiry_date=now()->addDays(365)}}">
                    <label class="fs-6" for="duration-radio-year">
                        {{__('1 Year')}}
                    </label>
                </div>
            </div>
            <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
                <input name="is_subscribed" value="{{ $customer->is_subscribed = 1 }}" type="hidden">
                <input name="is_member" value="{{$customer->is_member = 1}}" type="hidden">
                {{ Form::submit('Activate Membership', ['class' => 'btn btn-success'], url('/membership')) }}
            </div>


        @endif
        </div>
    </div>
    {!! Form::close() !!}

@endsection
