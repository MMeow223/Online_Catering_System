@extends('layouts.app')

@section('content')
    <div class="container">
{{--        <div class="shadow rounded border border-2 p-1 d-flex justify-content-between px-3">--}}
{{--            <div class="row">--}}
{{--                <div class="col pe-5 me-5">--}}
{{--                    {{ __('Product') }}--}}
{{--                </div>--}}
{{--                <div class="col  pe-5 me-5">--}}
{{--                    {{ __('Variation') }}--}}
{{--                </div>--}}
{{--            </div>--}}

{{--            <div class="row">--}}
{{--                <div class="col pe-5">--}}
{{--                    {{ __('Unit_Price') }}--}}
{{--                </div>--}}
{{--                <div class="col pe-5">--}}
{{--                    {{ __('Quantity') }}--}}
{{--                </div>--}}
{{--                <div class="col pe-5">--}}
{{--                    {{ __('Total_Price') }}--}}
{{--                </div>--}}
{{--                <div class="col pe-5">--}}
{{--                    {{ __('Action') }}--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="shadow rounded border border-2 p-1 d-flex justify-content-between px-3">--}}
{{--            <div class="row">--}}
{{--                <div class="col pe-5 me-5">--}}
{{--                    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/a/a8/Fresh_ramen_noodle_001.jpg/800px-Fresh_ramen_noodle_001.jpg" width="64" height="64">--}}
{{--                    {{ __('Noodle 12') }}--}}
{{--                </div>--}}
{{--                <div class="col  pe-5 me-5">--}}
{{--                    {{ __('Variation') }}--}}
{{--                </div>--}}
{{--            </div>--}}

{{--            <div class="row">--}}
{{--                <div class="col pe-5">--}}
{{--                    {{ __('RM15.00') }}--}}
{{--                </div>--}}
{{--                <div class="col pe-5">--}}
{{--                    {{ __('9') }}--}}
{{--                </div>--}}
{{--                <div class="col pe-5">--}}
{{--                    {{ __('RM156.00') }}--}}
{{--                </div>--}}
{{--                <div class="col pe-5">--}}
{{--                    {{ __('Delete') }}--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}


        <table class="table">
            <thead  class="shadow rounded-2 border-0 ">
            <tr>
                <th scope="col">Product</th>
                <th scope="col">Variation</th>
                <th scope="col">Unit Price</th>
                <th scope="col">Quantity</th>
                <th scope="col">Total Price</th>
                <th scope="col">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($cart_items as $item)
                <tr class="shadow align-middle m-2">
                    <td>
                        <img src="{{url("/images/$item->good_image")}}" width="64" height="64">
                        {{$item->good_name}}
                    </td>
                    <td class="align-middle">{{$item->good_variety_name}}</td>
                    <td class="align-middle">RM{{number_format((float)($item->good_price), 2, '.', '')}}</td>
                    <td class="align-middle">{{$item->quantity}}</td>
                    <td class="align-middle">RM{{ number_format((float)($item->good_price * $item->quantity), 2, '.', '')}}</td>
                    <td class="align-middle">
                        <form action="{{route('cart.destroy', $item->id)}}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>


    </div>
@endsection
