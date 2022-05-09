@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="justify-content-center text-center">
            @foreach ($orders as $order)
                <div class="card m-3">
                    @if(time() >= strtotime($order->delivery_time))
                        @php ($status = 4)
                        <h2 class="pt-3">{{ date('Y-m-d H:i', strtotime($order->delivery_time)) }}</h2>
                        <h2 class="p-1">Your Order is delivered</h2>
                        <img class="mx-auto p-2" src="{{URL("/images/111.png")}}" alt="status11" height="10%" width="40%">
                    @else
                        @if((time() + 86400) <= strtotime($order->delivery_time))
                            <h2 class="pt-3">{{ date('Y-m-d H:i', strtotime($order->delivery_time)) }}</h2>
                        @else
                            <h2 class="pt-3">{{ date('H:i', strtotime($order->delivery_time)) }}</h2>
                        @endif
                        @if($order->is_prepared == 1)
                            @if($order->is_delivered == 1)
                                @php ($status = 3)
                                <h2>Your Order is on the way</h2>
                                <img class="mx-auto p-2" src="{{URL("/images/11.png")}}" alt="status11" height="10%" width="40%">
                            @else
                                @php ($status = 2)
                                <h2> Your Order is being prepared</h2>
                                <img class="mx-auto p-2" src="{{URL("/images/10.png")}}" alt="status01" height="10%" width="40%">
                            @endif
                        @else
                            @php ($status = 1)
                            <h2> Your Order has been received</h2>
                            <img class="mx-auto p-2" src="{{URL("/images/00.png")}}" alt="status00" height="10%" width="40%">
                        @endif
                    @endif
                    <h2 class="pt-3">Item Purchased:</h2>
                    @foreach ($checkout as $check)
                        @if($order->id == $check->order_id)
                            <h2>{{  $check->good_name  }} : {{  $check->variety_name  }}</h2>
                        @endif
                    @endforeach
                    <h2 class="p-2 fw-bold">Total: RM{{$order->total_price}}</h2>
                </div>
            @endforeach
        </div>
    </div>
    <div class="px-5">
        {{ $orders->links('pagination::bootstrap-5') }}
    </div>
@endsection
