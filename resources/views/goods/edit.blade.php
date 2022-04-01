@extends('layouts.app')

@section('content')
    {!! Form::open(['route' => ['goods.update', $good->id], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow">
                    <div class="card-header d-flex justify-content-between">
                        <h5 class="my-auto">{{ __('Good') }}</h5>
                        <div>
                            {{ Form::hidden('_method', 'PUT') }}
                            {{ Form::submit('Update', ['class' => 'btn btn-primary float-right']) }}
                            <a href="{{ url()->previous() }}" class="btn btn-secondary float-right">{{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="form-group row my-2">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">

                                <input id="name" type="text" class="form-control" name="name" value="{{ $good->good_name }}" required autofocus >
                            </div>
                        </div>

                        <div class="form-group row my-2">
                            <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('Description') }}</label>

                            <div class="col-md-6">
                                <input id="description" type="text" class="form-control" name="description" value="{{ $good->good_description }}" required autofocus >
                            </div>
                        </div>

                        <div class="form-group row my-2">
                            <label for="price" class="col-md-4 col-form-label text-md-right">{{ __('Price') }}</label>

                            <div class="col-md-6">
                                <input id="price" type="text" class="form-control" name="price" value="{{ $good->good_price }}" required autofocus >
                            </div>
                        </div>

                        <div class="form-group row my-2">
                            <label for="category_id" class="col-md-4 col-form-label text-md-right">{{ __('Category') }}</label>

                            <div class="col-md-6">
                                <select id="category_id" class="form-control" name="category_id" required >
                                    <option value="{{ $category->id }}" @if($category->id == $good->good_category_id) selected @endif>{{ $category->category_title }}</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row my-2">
                            <label for="image" class="col-md-4 col-form-label text-md-right">{{ __('Image') }}</label>

                            <div class="col-md-6">
                                <img id="image" class="rounded shadow" height="200" width="200" src="https://i0.wp.com/post.healthline.com/wp-content/uploads/2020/09/french-fries-1296x728-header.jpg?w=1155&h=1528">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {!! Form::close() !!}

@endsection
