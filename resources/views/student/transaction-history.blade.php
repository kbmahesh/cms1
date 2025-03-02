@extends('layouts.student')

@section('content')
    <!-- Link the transaction-history-specific CSS -->
    <link rel="stylesheet" href="{{ asset('css/transaction-history.css') }}">

    <h1>Transaction History</h1>

    <div class="transaction-container">
        <!-- Transaction Table -->
        <table class="transaction-table">
            <thead>
                <tr>
                    <th>Transaction ID</th>
                    <th>Date</th>
                    <th>Fee Type</th>
                    <th>Description</th>
                    <th>Amount</th>
                    <th>Status</th>
                </tr>
            </thead>
            @foreach($transactions as $transaction)
            <tbody>
                <tr>
                    <td>{{$transaction->transaction_id}}</td>
                    <td>{{$transaction->date}}</td>
                    <td>{{ $transaction->feeType->fee_name ?? 'N/A' }}</td>
                    <td>{{$transaction->description}}</td>
                    <td>₹{{$transaction->amount}}</td>
                    <td class="{{ $transaction->status == 'Pending' ? 'status-pending' : 'status-paid' }}">{{$transaction->status}}</td>
                </tr>
            </tbody>
            @endforeach
        </table>
    </div>

    <div class="action-buttons">
        <a href="{{ url('/student-dashboard') }}" class="btn btn-secondary">Back to Dashboard</a>
        <a href="{{ url('/make-payment') }}" class="btn btn-primary">Make a Payment</a>
    </div>
@endsection
