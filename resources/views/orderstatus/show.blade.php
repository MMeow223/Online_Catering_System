@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>
            Shopping Cart
        </h1>
        <div class="rounded shadow row border border-2">
            <div class=" m-2 ms-4 fw-bold text-decoration-underline d-flex" style="color: #f35858">
                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="#f35858" class="bi bi-pin mx-1" viewBox="0 0 16 16">
                    <path d="M4.146.146A.5.5 0 0 1 4.5 0h7a.5.5 0 0 1 .5.5c0 .68-.342 1.174-.646 1.479-.126.125-.25.224-.354.298v4.431l.078.048c.203.127.476.314.751.555C12.36 7.775 13 8.527 13 9.5a.5.5 0 0 1-.5.5h-4v4.5c0 .276-.224 1.5-.5 1.5s-.5-1.224-.5-1.5V10h-4a.5.5 0 0 1-.5-.5c0-.973.64-1.725 1.17-2.189A5.921 5.921 0 0 1 5 6.708V2.277a2.77 2.77 0 0 1-.354-.298C4.342 1.674 4 1.179 4 .5a.5.5 0 0 1 .146-.354zm1.58 1.408-.002-.001.002.001zm-.002-.001.002.001A.5.5 0 0 1 6 2v5a.5.5 0 0 1-.276.447h-.002l-.012.007-.054.03a4.922 4.922 0 0 0-.827.58c-.318.278-.585.596-.725.936h7.792c-.14-.34-.407-.658-.725-.936a4.915 4.915 0 0 0-.881-.61l-.012-.006h-.002A.5.5 0 0 1 10 7V2a.5.5 0 0 1 .295-.458 1.775 1.775 0 0 0 .351-.271c.08-.08.155-.17.214-.271H5.14c.06.1.133.191.214.271a1.78 1.78 0 0 0 .37.282z"></path>
                </svg>
                Delivery Address & Datetime
            </div>
            <div class="row p-3">

                <span class="col-4"><span class="fw-bold">Elvis Wong Kiung Kiat +(60) 128946911</span> </span>
                <span class="col-6">
                    <span class="fst-italic text-muted">96, Jalan Uplands, Kampung Kenyalang Park, Kuching, 93200 Sarawak</span>
                    <br>
                    <span class="text-muted">19-05-2020 13:00 (3 days later from now)</span>
                </span>
                <span class="col-2"><a href="#" class="fw-bold text-black text-decoration-underline">CHANGE</a></span>
            </div>
        </div>

        <table class="table mt-5 ">
            <thead  class=" rounded-2 border-0 ">
            <tr style="background-color: #d7d8da">
                <th scope="col" class="p-2 py-1 rounded-start"><small>Product</small></th>
                <th scope="col" class="p-0 py-1"><small>Variation</small></th>
                <th scope="col" class="p-0 py-1"><small>Unit Price</small></th>
                <th scope="col" class="p-0 py-1"><small>Quantity</small></th>
                <th scope="col" class="p-0 py-1 rounded-end"><small>Total Price</small></th>
            </tr>
            </thead>
            <tbody>
            {{--            @foreach($cart_items as $item)--}}
            {{--                <input type="hidden" id="item_id" name="item_id" value="{{$item->id}}">--}}
            {{--                <tr class="shadow-sm align-middle">--}}
            {{--                    <td class="align-middle">--}}
            {{--                        <img src="{{url("/images/$item->good_image")}}" width="64" height="64">--}}
            {{--                        {{$item->good_name}}--}}
            {{--                    </td>--}}
            {{--                    <td class="align-middle">{{$item->good_variety_name}}</td>--}}
            {{--                    <td class="align-middle">RM{{number_format((float)($item->good_price), 2, '.', '')}}</td>--}}
            {{--                    <td class="align-middle">--}}
            {{--                        <div class="row">--}}
            {{--                            <div class="value-button" id="decrease" onmousedown="decreaseValue({{$item->id}})" onmouseup="updateDecreaseValue({{$item->id}})" value="Decrease Value">---}}
            {{--                            </div>--}}
            {{--                            <input type="number" name="quantity" class="quantity-input" id="number-{{$item->id}}" value="{{$item->quantity}}"/>--}}
            {{--                            <div class="value-button" id="increase" onmousedown="increaseValue({{$item->id}})" onmouseup="updateIncreaseValue({{$item->id}})" value="Increase Value">+--}}
            {{--                            </div>--}}
            {{--                        </div>--}}

            {{--                    </td>--}}
            {{--                    <td class="align-middle" id="cart-item-total-price-{{$item->id}}">RM{{ number_format((float)($item->good_price * $item->quantity), 2, '.', '')}}</td>--}}
            {{--                </tr>--}}
            {{--            @endforeach--}}
            <tr class="shadow-sm align-middle">
                <td class="align-middle">
                    <img src="" width="64" height="64">
                    Product Name
                </td>
                <td class="align-middle">Variation 1</td>
                <td class="align-middle">RM 10.00</td>
                <td class="align-middle">
                    <div class="row">
                        12
                    </div>
                </td>
                <td class="align-middle" id="cart-item-total-price">RM 120.00</td>
            </tr>

            </tbody>
        </table>

        <div class="mt-5 rounded shadow row justify-content-between border border-2">
            <div class="m-3 my-5 align-self-center">
                <span class="me-5 fw-bold">Payment Method</span>

                <input type="radio" class="btn-check" name="payment_method" id="payment_method_cod" >
                <label class="btn btn-outline-red p-1 d-inline-block" for="payment_method_cod">Cash On Delivery</label>

                <input type="radio" class="btn-check" name="payment_method" id="payment_method_ob" checked>
                <label class="btn btn-outline-red p-1 d-inline-block" for="payment_method_ob">Online Banking</label>

                {{--                <a href="#" class="btn btn-outline-red p-1 d-inline-block">Cash On Delivery</a>--}}
                {{--                <a href="#" class="btn btn-outline-red p-1">Online Banking</a>--}}
            </div>
            <div class="d-flex justify-content-end border-bottom border-2">
                <span class="m-2">Total Saved: <span class="fw-bold">RM 60</span>  <span class="fst-italic">(RM120 * 50% = RM60)</span> </span>
                <a href="#" class="btn btn-outline-warning border-2 m-2 p-0 px-2 disabled" >RAYA2022 50% OFF</a>
            </div>
            <div class="d-flex justify-content-end">
                <div class="row-col-2 justify-content-end">
                    <h3 class="m-2">Total Price</h3>
                    <span class="mx-2 row">(selected 2 items)</span>
                </div>
                <h3 id="cart-item-total-price" class="m-2 row text-decoration-line-through" style="color: #b6b6b6">RM 120.00</h3>
                <h1 id="cart-item-total-price" class="m-2 text-warning row">RM 60.00</h1>
                <a class="btn btn-outline-red px-5 py-2 align-self-center d-inline m-2" href="/placeorder">Place Order</a>
            </div>
        </div>
    </div>
@endsection





