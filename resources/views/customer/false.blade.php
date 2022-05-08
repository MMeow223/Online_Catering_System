@extends('layouts.app')

@section('content')
    {!! Form::open(['route' => ['deactivateMember', Auth::user()->id],'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
        <div class="form-group row my-2">
            <div class="col-md-6">
                @if($customer->is_member)
                    {{ Form::submit('Deactivate Membership', ['class' => 'btn btn-danger']) }}
                @else
                    {{ Form::submit('Activate Membership', ['class' => 'btn btn-success']) }}
                @endif
            </div>
        </div>
    {!! Form::close() !!}

@endsection
