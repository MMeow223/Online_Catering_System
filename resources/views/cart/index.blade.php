@extends('layouts.app')

@section('content')
    <div class="container">

        <h1>Shopping Cart</h1>
        <table class="table">
            <thead  class=" rounded-2 border-0 ">
            <tr style="background-color: #d7d8da">
                <th class="rounded-start"></th>
                <th scope="col" class="p-0 py-1"><small>Product</small></th>
                <th scope="col" class="p-0 py-1"><small>Variation</small></th>
                <th scope="col" class="p-0 py-1"><small>Unit Price</small></th>
                <th scope="col" class="p-0 py-1"><small>Quantity</small></th>
                <th scope="col" class="p-0 py-1"><small>Total Price</small></th>
                <th scope="col" class="p-0 py-1 rounded-end"><small>Action</small></th>
            </tr>
            </thead>
            <tbody>

                @foreach($cart_items as $item)
                    <input type="hidden" id="item_id" name="item_id" value="{{$item->id}}">
                    <tr class="shadow-sm align-middle">
                        <td class="align-middle">
                            <form action="/cart/update/select/{{$item->id}}" method="put">
                                <input onchange="this.form.submit()" class="form-check-input selectedItem" type="checkbox" id="selectedItem-{{$item->id}}}}" name="selectedItem-{{$item->id}}" value="{{$item->id}}" @if($item->selected) checked @endif>
                            </form>
                        </td>
                        <td class="align-middle">
                            <a href="/view/goods/{{$item->goods_id}}" class="text-decoration-none text-black">
                                <img src="{{url("/images/$item->good_image")}}" width="64" height="64">
                                {{$item->good_name}}
                            </a>
                        </td>
                        <td class="align-middle">{{$item->good_variety_name}}</td>
                        <td class="align-middle">RM{{number_format((float)($item->good_price), 2, '.', '')}}</td>
                        <td class="align-middle">
                            <div class="row">
                                <div class="value-button" id="decrease" onmousedown="decreaseValue({{$item->id}})" onmouseup="updateDecreaseValue({{$item->id}})" value="Decrease Value">-
                                </div>
                                <input type="number" name="quantity" class="quantity-input" id="number-{{$item->id}}" value="{{$item->quantity}}"/>
                                <div class="value-button" id="increase" onmousedown="increaseValue({{$item->id}})" onmouseup="updateIncreaseValue({{$item->id}})" value="Increase Value">+
                                </div>
                            </div>

                        </td>
                        <td class="align-middle" id="cart-item-total-price-{{$item->id}}">RM{{ number_format((float)($item->good_price * $item->quantity), 2, '.', '')}}</td>
                        <td class="align-middle">
                            <form id="delete-cart-item-form-{{$item->id}}" action="{{route('cart.destroy', $item->id)}}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach


            </tbody>
        </table>
        @if(count($cart_items) == 0)
            <h4 class="text-center m-5 p-5">No Cart Item Yet...</h4>
        @endif
        <div class="card my-5 shadow border-2">
            <div class="d-flex justify-content-end border-bottom border-2 p-3">


                <!-- Button trigger modal -->
                <a href="#" class="text-decoration-none text-black" data-bs-toggle="modal" data-bs-target="#exampleModal">



                    @if($current_using_voucher != null)
                        <span>Voucher Selected: </span>
                        <span class="m-2 btn btn-outline-warm" >{{$current_using_voucher->voucher_code}}</span>
                    @else
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-ticket my-auto" viewBox="0 0 16 16">
                            <path d="M0 4.5A1.5 1.5 0 0 1 1.5 3h13A1.5 1.5 0 0 1 16 4.5V6a.5.5 0 0 1-.5.5 1.5 1.5 0 0 0 0 3 .5.5 0 0 1 .5.5v1.5a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 0 11.5V10a.5.5 0 0 1 .5-.5 1.5 1.5 0 1 0 0-3A.5.5 0 0 1 0 6V4.5ZM1.5 4a.5.5 0 0 0-.5.5v1.05a2.5 2.5 0 0 1 0 4.9v1.05a.5.5 0 0 0 .5.5h13a.5.5 0 0 0 .5-.5v-1.05a2.5 2.5 0 0 1 0-4.9V4.5a.5.5 0 0 0-.5-.5h-13Z"/>
                        </svg>
                        <span class="m-2">Select Voucher</span>
                    @endif
                </a>

{{--                <!-- Button trigger modal -->--}}
{{--                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">--}}
{{--                    Launch demo modal--}}
{{--                </button>--}}

                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-scrollable">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Select a voucher</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                @if(count($vouchers) > 0)
                                    @foreach($vouchers as $voucher)
                                        <a href="/cart/update/voucher/{{$voucher->voucher_code}}" class="btn btn-outline-warm m-2 px-4 d-block rounded text-start">
                                            <h1 class="fw-bold">[{{$voucher->voucher_code}}]</h1>
                                            <hr>
                                            <h3> Discount {{$voucher->discount}}% with the limit of RM {{$voucher->price_limit}}</h3>
                                        </a>
                                    @endforeach
                                @else
                                    <h1 class="text-center">No voucher available</h1>
                                @endif

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                                @if(count($vouchers) > 0)
                                    <a href="/voucher/reset/{{auth()->user()->id}}" class="btn btn-primary">Clear Voucher</a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="d-flex justify-content-end">
                <div class="row-col-2 justify-content-end">
                    <h3 class="m-2">Total Price</h3>
                    <span class="mx-2 row">(selected {{$selectedItemCount}} items)</span>
                </div>

                <h1 id="cart-item-total-price" class="m-2 text-muted row text-decoration-line-through @if($current_using_voucher == null) d-none @endif">RM {{number_format((float)($total_price), 2, '.', '')}}</h1>
                <h1 id="cart-item-total-price-with-discount" class="m-2 text-warning row">RM {{number_format((float)($total_price_after_discount), 2, '.', '')}}</h1>
                <a class="btn btn-outline-red px-5 py-2 align-self-center d-inline m-2" href="/checkout">Checkout</a>
            </div>

        </div>
    </div>

    <div class="container col-10">

        <h1 class="row m-3">Some goods that you might interested with</h1>

        <div class="row">
            @forelse ($products as $product)
                <div class="col-3 ">
                    <a href="/view/goods/{{$product->id}}" class="d-inline text-decoration-none">
                        <div class="card m-3 shadow">
                            {{--                                <img class="card-img-top" src="https://www.thespruceeats.com/thmb/TLsKoV2dAENurB0yOSUnEzHYU_4=/1333x1000/smart/filters:no_upscale()/taiwanese-beef-noodle-soup-4777014-hero-01-e06a464badec476684e513cad44612da.jpg" alt="Card image" style="width:100%">--}}
                            <img class="card-img-top" src="{{url("/images/$product->good_image")}}"
                                 alt="Image of {{ $product->good_name }}" style="width:100%">

                            <div class="card-body">
                                <h4 class="card-title text-black">{{ $product->good_name }}</h4>
                                <p class="card-text text-black">{{ $product->good_description }}</p>
                                <p class="card-text text-black">RM{{ $product->good_price }}</p>
                            </div>
                        </div>
                    </a>
                </div>
            @empty
                <div>
                    <img src="/images/no-results.png" class=" mx-auto d-block pt-5" style="max-width: 10%">
                    <h1 class="text-center pt-5">
                        No results found
                    </h1>
                    <p class="text-center text-muted">
                        Try different or more general keywords
                    </p>
                </div>
            @endforelse
            <span>
                {{$products->appends(['search' => request() -> query('search')])->links('pagination::bootstrap-5') }}
            </span>
        </div>
    </div>

    <script>

        $(document).ready(function(){

            $(".selectedItem").click(function(){
                var selectedItems = [];
                $(".selectedItems:checked").each(function(){
                    selectedItems.push($(this).val());
                });
                console.log(selectedItems);
            });
        });
    </script>
    <script>
        function increaseValue(item_id) {
            let value = parseInt(document.getElementById('number-'+item_id).value, 10);
            value = isNaN(value) ? 0 : value;
            value++;
            document.getElementById('number-'+item_id).value = value;

        }

        function decreaseValue(item_id) {
            let value = parseInt(document.getElementById('number-'+item_id).value, 10);
            value = isNaN(value) ? 1 : value;

            if(value < 2){
                $("#delete-cart-item-form-"+item_id).submit();
            }
            else{
                value--;
                document.getElementById('number-'+item_id).value = value;
            }

        }

        function updateIncreaseValue(item_id){
            console.log(item_id)

            $.ajax({
                type: "GET",
                url: "/cart/update/quantity/increase/"+item_id,
                success: function(data){
                    console.log(data);
                    $('#cart-item-total-price').html(function(data){
                        console.log(data)
                        return 'RM ' + data.toFixed(2)
                    }(data[0]));

                    $('#cart-item-total-price-with-discount').html(function(data){
                        console.log(data);
                        return 'RM ' + data.toFixed(2)
                    }(data[1]));
                }
            })

            $.ajax({
                type: "GET",
                url: "/cart/update/cartItemPrice/"+item_id,
                success: function(data){
                    // console.log(data);

                    $('#cart-item-total-price-' + item_id).html(data);
                }
            })
        }

        function updateDecreaseValue(item_id){
            console.log(item_id)

            $.ajax({
                type: "GET",
                url: "/cart/update/quantity/decrease/"+item_id,
                success: function(data){
                    console.log(data);
                    $('#cart-item-total-price').html(function(data){
                        console.log(data)
                        return 'RM ' + data.toFixed(2)
                    }(data[0]));

                    $('#cart-item-total-price-with-discount').html(function(data){
                        console.log(data);
                        return 'RM ' + data.toFixed(2)
                    }(data[1]));
                }
            })

            $.ajax({
                type: "GET",
                url: "/cart/update/cartItemPrice/"+item_id,
                success: function(data){
                    console.log(data);

                    $('#cart-item-total-price-' + item_id).html(data);
                }
            })
        }
    </script>
@endsection





