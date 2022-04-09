@extends('layouts.app')

@section('content')
        <div class="row justify-content-center">
                <div class="card shadow">
                    <div class="card-header">
                        <div class=" d-flex justify-content-between">
                            <h3>{{ __('Payments') }}</h3>
                        </div>
                    </div>

                    <div class="card-body">

                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>{{ __('Payment Method') }}</th>
                                <th>{{ __('Account Number') }}</th>
                                <th>{{ __('Transaction ID') }}</th>
                                <th>{{ __('Total Amount (RM)') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($payments as $payment)
                                <tr>
                                    <td>{{ $payment->payment_method }}</td>
                                    <td>{{ $payment->account_number }}</td>
                                    <td>{{ $payment->transaction_id }}</td>
                                    <td>{{ $payment->total_amount }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="px-5">
                        {{ $payments->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            </div>

@endsection
