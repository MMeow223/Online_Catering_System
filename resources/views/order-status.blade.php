@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card-body">
            <div class="justify-content-center">
                @foreach ($orders as $order)
                    @if((time() + 86400) <= strtotime($order->delivery_time) || time() >= strtotime($order->delivery_time))
                        <h2>{{ date('Y-m-d H:i', strtotime($order->delivery_time)) }}</h2>
                    @else
                        <h2>{{ date('H:i', strtotime($order->delivery_time)) }}</h2>
                    @endif
                    @if(time() >= strtotime($order->delivery_time))
                        @php ($status = 4)
                        <h2>Your Order is delivered</h2>
                        <img src="{{URL("/images/111.png")}}" alt="status11" height="100" width="800">
                    @else
                        @if($order->is_prepared == 1)
                            @if($order->is_delivered == 1)
                                @php ($status = 3)
                                <h2>Your Order is on the way</h2>
                                <img src="{{URL("/images/11.png")}}" alt="status11" height="100" width="800">
                            @else
                                @php ($status = 2)
                                <h2> Your Order is being prepared</h2>
                                <img src="{{URL("/images/10.png")}}" alt="status01" height="100" width="800">
                            @endif
                        @else
                            @php ($status = 1)
                            <h2> Your Order has been received</h2>
                            <img src="{{URL("/images/00.png")}}" alt="status00" height="100" width="800">
                        @endif
                    @endif
                    <h2>Total: RM{{$order->total_price}}</h2>
                @endforeach
            </div>
        </div>
    </div>
    <div class="px-5">
        {{ $orders->links('pagination::bootstrap-5') }}
    </div>
@endsection
