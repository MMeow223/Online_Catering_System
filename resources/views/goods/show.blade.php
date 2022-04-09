@extends('layouts.app')

@section('content')
    <div >
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow">
                    <script>
                        window.onload = function() {

                            let type = "none";
                            if ({{ __($good->is_warm) }} === 1) {
                                type = "Warm";
                            } else if ({{ __($good->is_warm) }} === 0) {
                                type = "Cold";
                            }

                            let myOptions = ['Original'];

                            @foreach($variety as $j)
                                myOptions.push('{{ __($j->variety_name) }}');
                            @endforeach

                            let select = document.getElementById("variety_select");
                            for (let i = 1; i <= myOptions.length; i++) {
                                let option = '<option value="' + i + '" >' + myOptions[i - 1] + '</option>';
                                select.insertAdjacentHTML('beforeend', option);
                            }

                            document.getElementById("type").innerHTML = type;
                        };
                    </script>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="well"><img width="400" height="400" src="{{url("/images/$good->good_image")}}">
                                    <br/>
                                    <br/>
                                    <br/>
                                    <br/>
                                    <br/>
                                    <br/>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h3 class="well fs-3">{{ __($good->good_name) }}</h3>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="well fs-3">Category:</div>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="well fs-3"><option value="{{ $category->id }}">{{ $category->category_title }}</option></div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="well fs-3">Type:</div>
                                    </div>
                                    <div class="col-md-9">

                                        <p class="well fs-3" id = "type"></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="well fs-3" id="description">{{ __($good->good_description) }}</div>
                                </div>
                                <div class="row">
                                    <select class="form-control" name="variety_select" id="variety_select"></select>
                                    <div class="well fs-3" id="Price">RM{{ __($good->good_price) }}</div>
                                </div>
                                <div class="row">
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
                                    <form>
                                        <div class="value-button" id="decrease" onclick="decreaseValue()" value="Decrease Value">-</div>
                                        <input type="number" id="number" value="1" />
                                        <div class="value-button" id="increase" onclick="increaseValue()" value="Increase Value">+</div>
                                        <button class="btn btn-primary" id="AddtoCart" type="button">Add to Cart</button>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
