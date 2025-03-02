@extends('layouts.student')

@section('content')
    <!-- Link the fee-details-specific CSS -->
    <link rel="stylesheet" href="{{ asset('css/fee-details.css') }}">

    <h1>Fee Details</h1>

    <div class="fee-container">
        <!-- Fee Summary -->
        <div class="fee-card summary-card">
            <h3>Fee Summary</h3>
            <div class="fee-summary-info">
                <p><strong>Total Fee:</strong>₹{{ $feeSummary->total_fees ?? 'N/A' }}</p>
                <p><strong>Paid:</strong> ₹{{ $feeSummary->paid_amount ?? 'N/A' }}</p>
                <p><strong>Outstanding Balance:</strong> ₹{{ $feeSummary->overdue_total ?? 'N/A' }}</p>
                <p><strong>Last Payment Date:</strong> {{ \Carbon\Carbon::parse($lastPaymentDate)->format('F d, Y') }}</p>
            </div>
        </div>
    
        <!-- Fee Breakdown Table -->
        <div class="fee-card breakdown-card">
            @if ($feeDetails->sum('due_amount') > 0)
            <h3>Fee Breakdown</h3>
            <table>
                <thead>
                    <tr>
                        <th>Fee Type</th>
                        <th>Amount</th>
                        <th>Due Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                @foreach($feeDetails as $feeDetail)
                @if($feeDetail->due_amount > 0)
                <tbody>
                    <tr>
                        <td>{{$feeDetail->feeType->fee_name}}</td>
                        <td>₹{{$feeDetail->due_amount}}</td>
                        <td>{{ \Carbon\Carbon::parse($feeDetail->next_due_date)->format('F d, Y') }}</td>
                        <td>
                            <form action="{{ route('pay-now') }}" method="POST">
                                @csrf
                                <input type="hidden" name="amount" value="{{ $feeDetail->total_fees }}">
                                <input type="hidden" name="fee_name" value="{{ $feeDetail->feeType->fee_name }}">
                                <input type="hidden" name="fee_type_id" value="{{ $feeDetail->fee_type_id }}">
                                <button type="submit" class="btn">Pay Now</button>
                            </form>
                        </td>
                    </tr>
                </tbody>
                @endif
                @endforeach
            </table>
            @else
                <p><strong>✅ No pending dues! All fees are cleared.</strong></p>
            @endif
        </div>
    </div>

    <div class="action-buttons">
        <a href="{{ url('/student-dashboard') }}" class="btn btn-secondary">Back to Dashboard</a>
    </div>
@endsection
