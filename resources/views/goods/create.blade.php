@extends('layouts.app')

@section('content')
    {!! Form::open(['route' => ['goods.store'], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow">
                    <div class="card-header d-flex justify-content-between">
                        <h5 class="my-auto">{{ __('Good') }}</h5>
                        <div>
                            {{ Form::submit('Create', ['class' => 'btn btn-primary float-right']) }}
                            <a href="{{ url()->previous() }}" class="btn btn-secondary float-right">{{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="form-group row my-2">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">

                                <input id="name" type="text" class="form-control" name="name" value="" required autofocus >
                            </div>
                        </div>

                        <div class="form-group row my-2">
                            <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('Description') }}</label>

                            <div class="col-md-6">
                                <input id="description" type="text" class="form-control" name="description" value="" required autofocus >
                            </div>
                        </div>

                        <div class="form-group row my-2">
                            <label for="price" class="col-md-4 col-form-label text-md-right">{{ __('Price') }}</label>

                            <div class="col-md-6">
                                <input id="price" type="text" class="form-control" name="price" value="" required autofocus >
                            </div>
                        </div>

                        <div class="form-group row my-2">
                            <label for="category_id" class="col-md-4 col-form-label text-md-right">{{ __('Category') }}</label>

                            <div class="col-md-6">
                                <select id="category_id" class="form-control" name="category_id" required >
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->category_title }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group row my-2">
                            <label for="option_group" class="col-md-4 col-form-label text-md-right">{{ __('Food Type') }}</label>

                            <div class="col-md-6">

                                <div class="btn-group col-md-6" role="group" aria-label="Basic radio toggle button group">
                                    <input type="radio" class="btn-check" name="food_type_option" value=1 id="warm_outlined" autocomplete="off" checked>
                                    <label class="btn btn-outline-warm" for="warm_outlined">{{__('Warm')}}</label>

                                    <input type="radio" class="btn-check" name="food_type_option" value=0 id="cold_outlined" autocomplete="off">
                                    <label class="btn btn-outline-cold" for="cold_outlined">{{__('Cold')}}</label>

                                </div>
                            </div>
                        </div>

                        <div class="form-group row my-2">
                            <label for="image" class="col-md-4 col-form-label text-md-right">{{ __('Image') }}</label>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <input class="form-control" type="file" id="image">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {!! Form::close() !!}

@endsection
