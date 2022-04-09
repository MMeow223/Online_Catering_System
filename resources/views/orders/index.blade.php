@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow">
                    <div class="card-header">
                        <div class=" d-flex justify-content-between">
                            <h3>{{ __('Orders') }}</h3>
                        </div>
                    </div>

                    <div class="card-body">

                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>{{ __('User ID') }}</th>
                                <th>{{ __('Delivery Time') }}</th>
                                <th>{{ __('Total Price (RM)') }}</th>
                                <th>{{ __('Payment ID') }}</th>
                                <th>{{ __('Preparation Status') }}</th>
                                <th>{{ __('Delivery Status') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($orders as $order)
                                <tr>
                                    <td>{{ $order->user_id }}</td>
                                    <td>{{ $order->delivery_time }}</td>
                                    <td>{{ $order->total_price }}</td>
                                    <td>{{ $order->payment_id }}</td>
                                    <td>
                                        <input type="radio" class="btn-check" name="preparation_option" value=1 id="preparation_outlined" autocomplete="off" @if($order->is_prepared) checked @endif disabled >
                                        @if($order->is_prepared)
                                            <label class="btn btn-outline-success" for="preparation_outlined">{{__('Prepared')}}</label>
                                        @else
                                            <label class="btn btn-outline-danger" for="preparation_outlined">{{__('Not Prepared')}}</label>
                                        @endif
                                    </td>
                                    <td>
                                        <input type="radio" class="btn-check" name="delivery_option" value=1 id="delivery_outlined" autocomplete="off" @if($order->is_delivered) checked @endif disabled >
                                        @if($order->is_delivered)
                                            <label class="btn btn-outline-success" for="delivery_outlined">{{__('Delivered')}}</label>
                                        @else
                                            <label class="btn btn-outline-danger" for="delivery_outlined">{{__('Not Delivered')}}</label>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="px-5">
                        {{ $orders->links('pagination::bootstrap-5') }}awdasdawd
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
