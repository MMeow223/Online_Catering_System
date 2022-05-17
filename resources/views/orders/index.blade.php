@extends('layouts.app')

@section('content')
        <div class="row justify-content-center">
                <div class="card shadow">
                    <div class="card-header">
                        <div class=" d-flex justify-content-between">
                            <div>
                                <h3 class="d-inline">{{ __('Orders') }}</h3>
                                <small class="text-muted d-inline"> (View all order created and its delivery status)</small>
                            </div>
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

                            @if($orders->total()==0)
                                <tr class="d-flex">
                                    <td class="justify-content-center">{{ __('No orders found.') }}</td>
                                </tr>
                            @else

                                @foreach ($orders as $order)
                                    <tr>
                                        <td><a href="{{ route('users.show', $order->user_id) }}">{{ $order->user_id }}</a></td>
                                        <td>{{ $order->delivery_time }}</td>
                                        <td>{{ $order->total_price }}</td>
                                        <td><a href="{{ route('payments.show', $order->payment_id)}}">{{ $order->payment_id }}</a></td>
                                        <form action="update" method="POST">
                                            @csrf
                                            <td>
                                                <a href="{{ route('preparationStatus', $order->id) }}" class="btn @if($order->is_prepared) btn-success @else btn-outline-danger @endif" @if($order->is_prepared) checked @endif>@if($order->is_prepared) {{__('Prepared')}} @else {{__('Preparing')}}@endif</a>
                                            </td>
                                            <td>
                                                <a href="{{ route('deliverStatus', $order->id) }}" class="btn @if($order->is_delivered) btn-success @else btn-outline-danger @endif" @if($order->is_delivered) checked @endif >@if($order->is_delivered) {{__('Delivered')}} @else {{__('Delivering')}}@endif</a>
                                            </td>
                                        </form>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                    </div>
                    <div class="px-5">
                        {{ $orders->links('pagination::bootstrap-5') }}
                    </div>
                </div>
        </div>
@endsection
