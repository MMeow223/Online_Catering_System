@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow">
                    <div class="card-header">
                        <div class=" d-flex justify-content-between">
                            <h3>{{ __('Goods') }}</h3>
                            <div>

                                <a href="{{ route('goods.create') }}"
                                   class="btn btn-primary float-right">{{ __('Create') }}</a>
                                <a href="{{ url()->previous() }}"
                                   class="btn btn-secondary float-right">{{ __('Back') }}</a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>{{ __('Name') }}</th>
                                <th>{{ __('Price') }}</th>
                                <th>{{ __('Description') }}</th>
                                <th>{{ __('Actions') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($goods as $good)
                                <tr>
                                    <td>{{ $good->good_name }}</td>
                                    <td>{{ $good->good_price }}</td>
                                    <td>{{ $good->good_description }}</td>
                                    <td>
                                        <a href="{{ route('goods.show', $good->id) }}"
                                           class="btn btn-secondary">{{ __('Details') }}</a>
                                        <a href="{{ route('goods.edit', $good->id) }}"
                                           class="btn btn-primary">{{ __('Edit') }}</a>
                                        <form action="{{ route('goods.destroy', $good->id) }}" method="POST"
                                              class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">{{ __('Delete') }}</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="px-5">
                        {{ $goods->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
