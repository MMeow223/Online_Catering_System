@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow">
                    <div class="card-header d-flex justify-content-between">
                        <h5 class="my-auto">{{ __('Good') }}</h5>
                        <div>
                            <a href="{{route('goods.edit',$good->id)}}" class="btn btn-primary float-right">{{ __('Edit') }}</a>
                            <a href="{{ url()->previous() }}" class="btn btn-secondary float-right">{{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="form-group row my-2">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">

                                <input id="name" type="text" class="form-control" name="name" value="{{$good->good_name}}" required autofocus disabled>
                            </div>
                        </div>

                        <div class="form-group row my-2">
                            <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('Description') }}</label>

                            <div class="col-md-6">
                                <input id="description" type="text" class="form-control" name="description" value="{{$good->good_description}}" required autofocus disabled>
                            </div>
                        </div>

                        <div class="form-group row my-2">
                            <label for="price" class="col-md-4 col-form-label text-md-right">{{ __('Price') }}</label>

                            <div class="col-md-6">
                                <input id="price" type="text" class="form-control" name="price" value="{{$good->good_price}}" required autofocus disabled>
                            </div>
                        </div>

                        <div class="form-group row my-2">
                            <label for="category_id" class="col-md-4 col-form-label text-md-right">{{ __('Category') }}</label>

                            <div class="col-md-6">
                                <select id="category_id" class="form-control" name="category_id" required disabled>
                                    <option value="{{ $category->id }}">{{ $category->category_title }}</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row my-2">
                            <label for="option_group" class="col-md-4 col-form-label text-md-right">{{ __('Food Type') }}</label>

                            <div class="col-md-6">

                                <div class="btn-group col-md-6" role="group" aria-label="Basic radio toggle button group">
                                    <input type="radio" class="btn-check" name="food_type_option" value=1 id="warm_outlined" autocomplete="off" @if($good->is_warm) checked @endif disabled>
                                    <label class="btn btn-outline-warm" for="warm_outlined">{{__('Warm')}}</label>

                                    <input type="radio" class="btn-check" name="food_type_option" value=0 id="cold_outlined" autocomplete="off" @if($good->is_warm == false) checked @endif disabled>
                                    <label class="btn btn-outline-cold" for="cold_outlined">{{__('Cold')}}</label>

                                </div>
                            </div>
                        </div>

                        <div class="form-group row my-2">
                            <label for="option_group" class="col-md-4 col-form-label text-md-right">{{ __('Food Type') }}</label>

                            <div class="col-md-6">

                                <div class="btn-group col-md-6" role="group" aria-label="Basic radio toggle button group">
                                    <input type="radio" class="btn-check" name="availability_option" value=1 id="available_outlined" autocomplete="off" @if($good->is_available) checked @endif  disabled>
                                    <label class="btn btn-outline-success" for="available_outlined">{{__('Available')}}</label>

                                    <input type="radio" class="btn-check" name="availability_option" value=0 id="not_available_outlined" autocomplete="off" @if($good->is_available == false) checked @endif disabled>
                                    <label class="btn btn-outline-danger" for="not_available_outlined">{{__('Unavailable')}}</label>

                                </div>
                            </div>
                        </div>

                        <div class="form-group row my-2">
                            <label for="image" class="col-md-4 col-form-label text-md-right">{{ __('Image') }}</label>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <img width="200" height="200" src="{{url("/images/$good->good_image")}}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
