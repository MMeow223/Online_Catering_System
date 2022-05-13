@extends('layouts.app')

@section('content')

    <div class="container">
        <h1>
            Order Details
        </h1>


        @if(time() >= strtotime($order_details->delivery_time))
            @php ($status = 4)
            <img class="col mx-auto m-5 d-block" src="{{URL("/images/111.png")}}" alt="status11" height="100px" width="auto">
        @else
            @if($order_details->is_prepared == 1)
                @if($order_details->is_delivered == 1)
                    @php ($status = 3)
                    <img class="mx-auto" src="{{URL("/images/11.png")}}" alt="status11" height="100px" width="auto">
                @else
                    @php ($status = 2)
                    <img class="mx-auto col" src="{{URL("/images/10.png")}}" alt="status01" height="100px" width="auto">
                @endif
            @else
                @php ($status = 1)
                <img class="mx-auto p-2 col" src="{{URL("/images/00.png")}}" alt="status00" height="100px" width="auto">
            @endif
        @endif


        <div class="rounded shadow row border border-2">
            <div class=" m-2 ms-4 fw-bold text-decoration-underline d-flex" style="color: #f35858">
                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="#f35858" class="bi bi-pin mx-1"
                     viewBox="0 0 16 16">
                    <path
                        d="M4.146.146A.5.5 0 0 1 4.5 0h7a.5.5 0 0 1 .5.5c0 .68-.342 1.174-.646 1.479-.126.125-.25.224-.354.298v4.431l.078.048c.203.127.476.314.751.555C12.36 7.775 13 8.527 13 9.5a.5.5 0 0 1-.5.5h-4v4.5c0 .276-.224 1.5-.5 1.5s-.5-1.224-.5-1.5V10h-4a.5.5 0 0 1-.5-.5c0-.973.64-1.725 1.17-2.189A5.921 5.921 0 0 1 5 6.708V2.277a2.77 2.77 0 0 1-.354-.298C4.342 1.674 4 1.179 4 .5a.5.5 0 0 1 .146-.354zm1.58 1.408-.002-.001.002.001zm-.002-.001.002.001A.5.5 0 0 1 6 2v5a.5.5 0 0 1-.276.447h-.002l-.012.007-.054.03a4.922 4.922 0 0 0-.827.58c-.318.278-.585.596-.725.936h7.792c-.14-.34-.407-.658-.725-.936a4.915 4.915 0 0 0-.881-.61l-.012-.006h-.002A.5.5 0 0 1 10 7V2a.5.5 0 0 1 .295-.458 1.775 1.775 0 0 0 .351-.271c.08-.08.155-.17.214-.271H5.14c.06.1.133.191.214.271a1.78 1.78 0 0 0 .37.282z"></path>
                </svg>
                Delivery Address
            </div>
            <div class="row p-3">

                <span class="col-4"><span
                        class="fw-bold">{{$customer_information->institution_name}} {{$customer_information->phone}}</span> </span>
                <span class="col-4">
                    <span class="fst-italic text-muted">{{$customer_information->institution_address}}</span>
                    <br>
                </span>

                <span class="col-4">
                    <span class="fst-italic text-muted">Will delivered by: put the delivery date here</span>
                    <br>
                </span>
            </div>
        </div>

        <table class="table mt-5 ">
            <thead class=" rounded-2 border-0 ">
            <tr style="background-color: #d7d8da">
                <th scope="col" class="p-2 py-1 rounded-start"><small>Product</small></th>
                <th scope="col" class="p-0 py-1"><small>Variation</small></th>
                <th scope="col" class="p-0 py-1"><small>Unit Price</small></th>
                <th scope="col" class="p-0 py-1"><small>Quantity</small></th>
                <th scope="col" class="p-0 py-1 rounded-end"><small>Total Price</small></th>
            </tr>
            </thead>
            <tbody>
            {{--            {{dd(  $selected_cart_items)   }}--}}
            @foreach($checkout_items as $item)

                <tr class="shadow-sm align-middle">
                    <td class="align-middle">
                        <img src="{{url("/images/$item->good_image")}}" width="64" height="64">
                        {{$item->good_name}}
                    </td>
                    <td class="align-middle">{{$item->variety_name}}</td>
                    <td class="align-middle">RM{{ number_format((float)($item->good_price), 2, '.', '')}}</td>
                    <td class="align-middle">
                        <div class="row">
                            {{$item->quantity}}
                        </div>
                    </td>
                    <td class="align-middle" id="cart-item-total-price">
                        RM{{ number_format((float)($item->good_price * $item->quantity), 2, '.', '')}}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <form action="/placeOrder" method="put" id="place-order-form">

            <div class="mt-5 rounded shadow row justify-content-between border border-2">

                <div class="d-flex justify-content-end">
                    <div class="row-col-2 justify-content-end">
                        <h3 class="m-2">Total Price</h3>
                        <span class="mx-2 row">(selected 2 items)</span>
                    </div>
                    <h1 id="cart-item-total-price-with-discount" class="m-2 text-warning row">
                        RM {{number_format((float)($order_details->total_price), 2, '.', '')}}</h1>
                </div>
            </div>
        </form>

    </div>


@endsection





