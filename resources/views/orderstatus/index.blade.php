@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="justify-content-center">
            @foreach ($orders as $order)
                <div class="card m-3 row">

                    @if(time() >= strtotime($order->delivery_time))
                        @php ($status = 4)
                        <p class="col">Order created at: {{ date('Y-m-d H:i', strtotime($order->delivery_time)) }}</p>
                        <p class="col">Your Order is delivered</p>
                        <img class="col mx-auto" src="{{URL("/images/111.png")}}" alt="status11" height="50px" width="auto">
                    @else
                        @if((time() + 86400) <= strtotime($order->delivery_time))
                            <p class="pt-3">Order created at: {{ date('Y-m-d H:i', strtotime($order->delivery_time)) }}</p>
                        @else
                            <p class="pt-3">Order created at: {{ date('H:i', strtotime($order->delivery_time)) }}</p>
                        @endif
                        @if($order->is_prepared == 1)
                            @if($order->is_delivered == 1)
                                @php ($status = 3)
                                <p>Your Order is on the way</p>
                                <img class="mx-auto" src="{{URL("/images/11.png")}}" alt="status11" height="50px" width="auto">
                            @else
                                @php ($status = 2)
                                <p> Your Order is being prepared</p>
                                <img class="mx-auto col" src="{{URL("/images/10.png")}}" alt="status01" height="50px" width="auto">
                            @endif
                        @else
                            @php ($status = 1)
                            <p> Your Order has been received</p>
                            <img class="mx-auto p-2 col" src="{{URL("/images/00.png")}}" alt="status00" height="50px" width="auto">
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
            @endforeach
        </div>
    </div>
    <div class="px-5">
        {{ $orders->links('pagination::bootstrap-5') }}
    </div>
@endsection
