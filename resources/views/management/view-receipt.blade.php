@extends('layouts.management')

@section('content')

<!-- Link to external CSS -->
<link rel="stylesheet" href="{{ asset('css/receipt.css') }}">

<div class="receipt-container">
    <h2>Receipt Details</h2>

    <table class="receipt-table">
        <tr>
            <td><strong>Transaction ID:</strong></td>
            <td>{{ $transaction->transaction_id }}</td>
        </tr>
        <tr>
            <td><strong>Student ID:</strong></td>
            <td>{{ $transaction->student_id }}</td>
        </tr>
        <tr>
            <td><strong>Amount:</strong></td>
            <td>₹{{ number_format($transaction->amount, 2) }}</td>
        </tr>
        <tr>
            <td><strong>Payment Mode:</strong></td>
            <td>{{ $transaction->payment_mode }}</td>
        </tr>
        <tr>
            <td><strong>Date:</strong></td>
            <td>{{ \Carbon\Carbon::parse($transaction->date)->format('d M Y') }}</td>
        </tr>
        <tr>
            <td><strong>Status:</strong></td>
            <td class="{{ $transaction->status == 'Pending' ? 'status-pending' : 'status-paid' }}">
                {{ $transaction->status }}
            </td>
        </tr>
    </table>

    <div class="proof-container">
        <h4>Payment Proof</h4>
        @if($transaction->proof_image)
            <img src="data:image/jpeg;base64,{{ $transaction->proof_image }}" class="proof-image">
        @else
            <p class="status-pending">No Proof Uploaded</p>
        @endif
    </div>

    @if($transaction->status == 'Pending')
        <div class="proof-container">
            <form action="{{ route('transactions.approve', $transaction->transaction_id) }}" method="POST">
                @csrf
                @method('PUT')
                <button type="submit" name="status" value="Paid" class="approve-btn"
                        onclick="return confirm('Are you sure you want to approve this payment?');">
                    ✅ Approve Payment
                </button>
            </form>
        </div>
    @else
        <p class="verified-text">Already Verified</p>
    @endif
</div>

@endsection
