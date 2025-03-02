@extends('layouts.management')

@section('content')
<link rel="stylesheet" href="{{ asset('css/mfeedetails.css') }}">
<div class="container">
    <h2 class="page-title">Fee Details - {{ $student->first_name }} {{ $student->last_name }}</h2>

    <div class="student-info">
        <p><strong>Student ID:</strong> {{ $student->student_id }}</p>
        <p><strong>Branch:</strong> {{ $student->academicDetails->Branch ?? 'N/A' }}</p>
        <p><strong>Course:</strong> {{ $student->academicDetails->Course ?? 'N/A' }}</p>
        <p><strong>Semester:</strong> {{ $student->academicDetails->Semester ?? 'N/A' }}</p>
    </div>

    <h3 class="section-title">Fee Breakdown</h3>
    <table class="table fee-details-table">
        <thead>
            <tr>
                <th>Fee Type</th>
                <th>Total Fees</th>
                <th>Paid Amount</th>
                <th>Remaining Amount</th>
                <th>Payment Status</th>
                <th>Payment Mode</th>
                <th>Due Date</th>
                <th>Remarks</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($student->FeeDetail as $fee)
                <tr>
                    <td>{{ $fee->feeType->fee_name ?? 'N/A' }}</td>
                    <td>₹{{ number_format($fee->total_fees, 2) }}</td>
                    <td>₹{{ number_format($fee->paid_amount, 2) }}</td>
                    <td>₹{{ number_format($fee->due_amount, 2) }}</td>
                    <td>
                        <span class="status {{ strtolower($fee->payment_status) }}">
                            {{ $fee->payment_status }}
                        </span>
                    </td>
                    <td>{{ $fee->payment_mode ?? 'N/A' }}</td>
                    <td>{{ $fee->next_due_date ?? 'N/A' }}</td>
                    <td>{{ $fee->remarks ?? '-' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <a href="{{ route('view.fees') }}" class="btn btn-secondary">Back</a>
</div>
@endsection
