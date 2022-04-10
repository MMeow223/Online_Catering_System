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
                                    <td>
                                        <a href="{{ route('payments.show', $payment->id) }}"
                                           class="btn btn-secondary">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-info-lg" viewBox="0 0 16 16">
                                                <path d="m9.708 6.075-3.024.379-.108.502.595.108c.387.093.464.232.38.619l-.975 4.577c-.255 1.183.14 1.74 1.067 1.74.72 0 1.554-.332 1.933-.789l.116-.549c-.263.232-.65.325-.905.325-.363 0-.494-.255-.402-.704l1.323-6.208Zm.091-2.755a1.32 1.32 0 1 1-2.64 0 1.32 1.32 0 0 1 2.64 0Z"/>
                                            </svg>
                                        </a>
                                    </td>
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
