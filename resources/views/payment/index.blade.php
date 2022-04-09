@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow">
                    <div class="card-header">
                        <div class=" d-flex justify-content-between">
                            <h3>{{ __('Payment') }}</h3>
                        </div>
                    </div>

                    <div class="card-body">

                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>{{ __('Payment Method') }}</th>
                                <th>{{ __('Account Number') }}</th>
                                <th>{{ __('Transaction ID') }}</th>
                                <th>{{ __('Total Amount') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($payment as $pay)
                                <tr>
                                    <td>{{ $pay->payment_method }}</td>
                                    <td>{{ $pay->account_number }}</td>
                                    <td>{{ $pay->transaction_id }}</td>
                                    <td>{{ $pay->total_amount }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="px-5">
                        {{ $payment->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
