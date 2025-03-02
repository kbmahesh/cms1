@extends('layouts.management')

@section('content')
<link rel="stylesheet" href="{{ asset('css/viewfees.css') }}">
<div class="container">
    <h2 class="mb-4">Student Fees Details</h2>

    <!-- Filter Form -->
    <form method="GET" action="{{ route('view.fees') }}" class="filter-container mb-4">

        <div class="col-md-3">
            <input type="text" name="student_id" class="form-control" placeholder="Search by Student ID" value="{{ request('student_id') }}">
        </div>
        <div class="col-md-3">
            <select name="branch" class="form-control">
                <option value="">Select Branch</option>
                @foreach($branches as $branch)
                    <option value="{{ $branch->Branch }}" {{ request('branch') == $branch->Branch ? 'selected' : '' }}>
                        {{ $branch->Branch }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-md-3">
            <select name="course" class="form-control">
                <option value="">Select Course</option>
                @foreach($courses as $course)
                    <option value="{{ $course->Course }}" {{ request('course') == $course->Course ? 'selected' : '' }}>
                        {{ $course->Course }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-md-3">
            <select name="semester" class="form-control">
                <option value="">Select Semester</option>
                @for($i = 1; $i <= 8; $i++)
                    <option value="{{ $i }}" {{ request('semester') == $i ? 'selected' : '' }}>
                        Semester {{ $i }}
                    </option>
                @endfor
            </select>
        </div>
        <div class="col-md-12 d-flex justify-content-between mt-2">
            <button type="submit" class="btn btn-primary">Filter</button>
            <a href="{{ route('view.fees') }}" class="btn btn-secondary">Reset</a>
        </div>

    </form>


    <!-- Fees Table -->
    <table class="table table-bordered table-hover">
        <thead class="table-dark">
            <tr>
                <th>Student ID</th>
                <th>Name</th>
                <th>Branch</th>
                <th>Total Fees</th>
                <th>Paid Amount</th>
                <th>Remaining Amount</th>
                <th>Payment Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($students as $student)
                @php
                    $fee = optional($student->feeDetails)->first(); 
                @endphp
                <tr>
                    <td>{{ $student->student_id }}</td>
                    <td>{{ $student->first_name }} {{ $student->last_name }}</td>
                    <td>{{ $student->academicDetails->Branch ?? 'N/A' }}</td>
                    <td>₹{{ number_format($student->feeSummary->total_fees ?? 0, 2) }}</td>
                    <td class="text-success">₹{{ number_format($student->feeSummary->paid_amount ?? 0, 2) }}</td>
                    <td class="text-danger">₹{{ number_format($student->feeSummary->overdue_total ?? 0, 2) }}</td>
                    <td>
                    <span class="badge 
                        {{ $student->feeSummary && $student->feeSummary->payment_status == 'Paid' ? 'text-success' : 
                        ($student->feeSummary && $student->feeSummary->payment_status == 'Partially Paid' ? 'text-warning' : 'text-danger') }}">
                        {{ $student->feeSummary->payment_status ?? 'Pending' }}
                    </span>

                    </td>
                    <td>
                        <a href="{{ route('fees.details', $student->student_id) }}" class="btn btn-info">View</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $students->links() }} <!-- Pagination -->
</div>
@endsection
