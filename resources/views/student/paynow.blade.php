@extends('layouts.student')

@section('content')
<link rel="stylesheet" href="{{ asset('css/paynow.css') }}">
<div class="pay-container">
    <h2>Pay Now via Bank Transfer / UPI</h2>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Payment Instructions Section -->
    <div class="inst">
        <h4>Payment Instructions:</h4>
        <p><strong>Pay to:</strong> XYZ University Fees Account</p>
        <p><strong>UPI ID:</strong> xyzuniversity@upi</p>
        <p><strong>Bank Account Details:</strong></p>
        <ul>
            <li><strong>Bank:</strong> ABC Bank</li>
            <li><strong>Account Number:</strong> 123456789012345</li>
            <li><strong>IFSC Code:</strong> ABCD1234</li>
        </ul>
        <p><strong>Amount:</strong> Please ensure that you pay the correct fee amount as per your fees details.</p>
        <p><strong>Important:</strong> After making the payment, upload the screenshot of the transaction below.</p>
    </div>

    <!-- QR Code Display -->
    <div class="qr-container">
        <h4>Scan to Pay (UPI)</h4>
        <!-- Assuming you have generated a QR code image for UPI payment -->
        <img src="{{ asset('images/Payment QR.jpg') }}" alt="UPI QR Code">
        <p>Use the UPI QR code above to make a payment easily!</p>
    </div>

    <!-- Payment Form -->
    <form action="{{ route('pay-now.submit') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label for="amount">Amount</label>
            <input type="text" name="amount" id="amount" value="{{ $feeDetails['amount'] ?? '' }}" readonly>
            <label for="fee type">Fee Type</label>
            <input type="text" id="fee_name" value="{{ $feeDetails['fee_name'] ?? '' }}" readonly>
            <label for="payment_mode">Payment Mode</label>
            <select name="payment_mode" id="payment_mode" required>
                <option value="">Select Payment Mode</option>
                <option value="Bank Transfer">Bank Transfer</option>
                <option value="UPI">UPI</option>
            </select>
            <!-- Hidden field to store Fee Type ID -->
            <input type="hidden" name="fee_type_id" id="fee_type_id" value="{{ $feeDetails['fee_type_id'] ?? '' }}">
        </div>

        <!-- Upload Screenshot -->
        <div class="form-group">
            <label for="payment_proof">Upload Screenshot of Bank Transaction</label>
            <input type="file" name="payment_proof" id="payment_proof" accept="image/jpeg" required>
            @if($errors->has('payment_proof'))
                <div class="error">{{ $errors->first('payment_proof') }}</div>
            @endif
        </div>

        <div class="form-group">
            <button type="submit">Submit Payment</button>
        </div>
    </form>
</div>
@endsection
