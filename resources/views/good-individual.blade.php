@extends('layouts.app')

@section('content')
    <div class="container">

        {{--        <div class="">--}}
        <div class="row shadow-lg p-5 mt-3" style="padding-bottom: 200px !important; ">
            <h2 class="toast-body bg-warning fw-bold rounded">Displaying {{ __($good->good_name) }}</h2>

            <div class="col">

                <img class="d-flex m-3 shadow-lg rounded" width="400"
                     src="{{url("/images/$good->good_image")}}">
            </div>
            <div class="col">
                {{--                <div class="col-md-8">--}}
                <div class="row">
                    <h4 class="col-md-4 fw-bold">Name </h4>
                    <h4 class="col-md-8">: {{ __($good->good_name) }}</h4>
                </div>

                <div class="row">
                    <h4 class="col-md-4 fw-bold">Category </h4>
                    <h4 class="col-md-8">: {{ $category->category_title }}</h4>
                </div>

                <div class="row">
                    <h4 class="col-md-4 fw-bold">Type</h4>
                    <h4 class="col-md-8" id="type">: @if($good->is_warm) Warm @else Cold @endif</h4>
                </div>

                <div class="row">
                    <h4 class="col-md-4 fw-bold">Description</h4>
                    <h4 class="col-md-8" id="type">: {{ __($good->good_description) }}</h4>
                </div>
                <form action="{{route('cart.store')}}" method="post">
                    @csrf
                    <input type="hidden" name="good_id" value="{{$good->id}}">
                    <div class="row">
                        <h4 class="col-md-4 fw-bold">Variety</h4>

                        <div class="col-md-8">
                            <h4>: </h4>
                            <div class="row">
                                @if(!($varieties->isEmpty()))
                                    @foreach($varieties as $variety)

                                        <div class="col-4 form-check  me-4">
                                            <input class="form-check-input fs-5" type="radio" name="variety-radio"
                                                   id="variety-radio-{{$variety->id}}" value="{{$variety->id}}">
                                            <label class="form-check-label fs-5" for="variety-radio-{{$variety->id}}">
                                                {{$variety->variety_name}}
                                            </label>
                                        </div>
                                    @endforeach
                                @else
                                    <div class=" col form-check form-check-inline py-2">
                                        <input name="variety-checkbox-default" class="form-check-input"
                                               type="checkbox" id="variety-checkbox-default" value="1" checked disabled>
                                        <label class="form-check-label"
                                               for="variety-checkbox-default">Default</label>
                                    </div>
                                @endif
                            </div>
                        </div>

                    </div>

                    <h1>RM{{ __($good->good_price) }}</h1>

                    <div class="row">
                        <div class="value-button" id="decrease" onclick="decreaseValue()" value="Decrease Value">-
                        </div>
                        <input type="number" class="quantity-input" name="quantity" id="number" value="1"/>
                        <div class="value-button" id="increase" onclick="increaseValue()" value="Increase Value">+
                        </div>
                        <button class="btn btn-primary" id="AddtoCart" type="submit" >Add to Cart</button>
                    </div>
                </form>
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
        function increaseValue() {
            let value = parseInt(document.getElementById('number').value, 10);
            value = isNaN(value) ? 0 : value;
            value++;
            document.getElementById('number').value = value;
        }

        function decreaseValue() {
            let value = parseInt(document.getElementById('number').value, 10);
            value = isNaN(value) ? 1 : value;
            value < 2 ? value = 2 : '';
            value--;
            document.getElementById('number').value = value;
        }
    </script>

@endsection
