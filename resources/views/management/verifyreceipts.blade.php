@extends('layouts.management')

@section('content')
<div class="container">
    <h2>Pending Receipts</h2>

    <table class="table">
        <thead>
            <tr>
                <th>Transaction ID</th>
                <th>Student ID</th>
                <th>Amount</th>
                <th>Payment Mode</th>
                <th>Payment Date</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($transactions as $transaction)
                <tr>
                    <td>{{ $transaction->transaction_id }}</td>
                    <td>{{ $transaction->student_id }}</td>
                    <td>₹{{ number_format($transaction->amount, 2) }}</td>
                    <td>{{ $transaction->payment_mode }}</td>
                    <td>{{ \Carbon\Carbon::parse($transaction->date)->format('d M Y') }}</td>
                    <td>
                        <a href="{{ route('transactions.view', $transaction->transaction_id) }}" class="btn btn-info">
                            View
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
