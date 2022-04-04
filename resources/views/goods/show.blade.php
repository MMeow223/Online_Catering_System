@extends('layouts.app')

@section('content')
    <div class="container">
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
                                <div class="well"><img width="240" height="240" src="{{url("/images/$good->good_image")}}">
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
                                        <h3 class="well">{{ __($good->good_name) }}</h3>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="well">Category:</div>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="well"><option value="{{ $category->id }}">{{ $category->category_title }}</option></div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="well">Type:</div>
                                    </div>
                                    <div class="col-md-9">

                                        <p id = "type"></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="well" id="description">{{ __($good->good_description) }}</div>
                                </div>
                                <div class="row">

                                    <select name="variety_select" id="variety_select"></select>
                                    <div class="well">RM{{ __($good->good_price) }}</div>
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
                                    value = isNaN(value) ? 0 : value;
                                    value < 1 ? value = 1 : '';
                                    value--;
                                    document.getElementById('number').value = value;
                                    }
                                    </script>
                                    <form>
                                        <div class="value-button" id="decrease" onclick="decreaseValue()" value="Decrease Value">-</div>
                                        <input type="number" id="number" value="1" />
                                        <div class="value-button" id="increase" onclick="increaseValue()" value="Increase Value">+</div>
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
