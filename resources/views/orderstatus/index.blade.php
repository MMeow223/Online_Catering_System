@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Orders Placed</h1>
        <div class="justify-content-center">
            @foreach ($orders as $order)
                <a class="text-decoration-none text-black" href="{{ route('orderView', $order->id) }}" >
                    <div class="card m-3 row" >
                        @if(time() >= strtotime($order->delivery_time))
                            <p class="col">{{ date('Y-m-d H:i', strtotime($order->delivery_time)) }}</p>
                            <p class="col">Your Order is delivered</p>
                            <img class="col mx-auto" src="{{URL("/images/111.png")}}" alt="status11" height="auto" width="auto">
                        @else
                            @if((time() + 86400) <= strtotime($order->delivery_time))
                                <p class="pt-3">Order will delivered by: {{ date('Y-m-d H:i', strtotime($order->delivery_time)) }}</p>
                            @else
                                <p class="pt-3">Order will delivered by: {{ date('H:i', strtotime($order->delivery_time)) }}</p>
                            @endif
                            @if($order->is_prepared == 1)
                                @if($order->is_delivered == 1)
                                    <p>Your Order is on the way</p>
                                    <img class="mx-auto" src="{{URL("/images/11.png")}}" alt="status11" height="auto" width="auto">
                                @else
                                    <p> Your Order is being prepared</p>
                                    <img class="mx-auto col" src="{{URL("/images/10.png")}}" alt="status01" height="auto" width="auto">
                                @endif
                            @else
                                <p> Your Order has been received</p>
                                <img class="mx-auto p-2 col" src="{{URL("/images/00.png")}}" alt="status00" height="auto" width="auto">
                            @endif
                        @endif
                        <p class="col">Item Purchased:</p>
                        @foreach ($checkout as $check)
                            @if($order->id == $check->order_id)
                                <p>{{  $check->good_name  }} : {{  $check->variety_name  }}</p>
                            @endif
                        @endforeach
                        <p class=" fw-bold">Total: RM{{$order->total_price}}</p>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
    <div class="px-5">
        {{ $orders->links('pagination::bootstrap-5') }}
    </div>
@endsection
