@extends('layouts.management')

@section('content')
<link rel="stylesheet" href="{{ asset('css/viewstudent.css') }}">

<div class="container">
    <h2>Student Details</h2>

    <div class="student-details">
        <!-- Personal Information -->
        <h4>Personal Information</h4>
        <p><strong>Student ID:</strong> {{ $student->student_id }}</p>
        <p><strong>Full Name:</strong> {{ $student->first_name }} {{ $student->last_name }}</p>
        <p><strong>Date of Birth:</strong> {{ $student->dob }}</p>
        <p><strong>Gender:</strong> {{ $student->gender }}</p>
        <p><strong>Email:</strong> {{ $student->email }}</p>
        <p><strong>Phone Number:</strong> {{ $student->phone }}</p>
        <p><strong>Address:</strong> {{ $student->address }}</p>

        <!-- Academic Details -->
        <h4>Academic Details</h4>
        <p><strong>Course:</strong> {{ $student->academicDetails->Course ?? 'N/A' }}</p>
        <p><strong>Branch:</strong> {{ $student->academicDetails->Branch ?? 'N/A' }}</p>
        <p><strong>Semester:</strong> {{ $student->academicDetails->Semester ?? 'N/A' }}</p>
        <p><strong>Admission Year:</strong> {{ $student->academicDetails->AdmissionDate ?? 'N/A' }}</p>

        <!-- Guardian Details -->
        <h4>Guardian Details</h4>
        <p><strong>Guardian Name:</strong> {{ $student->guardians->guardian_name ?? 'N/A' }}</p>
        <p><strong>Relationship:</strong> {{ $student->guardians->relationship ?? 'N/A' }}</p>
        <p><strong>Guardian Contact:</strong> {{ $student->guardians->phone ?? 'N/A' }}</p>

        <!-- Fee Details -->
        @if(isset($student->feeDetails))
        <h4>Financial Details</h4>
        <p><strong>Total Fees:</strong> ₹{{ $student->feeDetails->total_fees ?? 'N/A' }}</p>
        <p><strong>Paid Amount:</strong> ₹{{ $student->feeDetails->total_paid ?? 'N/A' }}</p>
        <p><strong>Pending Amount:</strong> ₹{{ $student->feeDetails->overdue_total ?? 'N/A' }}</p>
        @endif
    </div>
    <div class="action-buttons">
        <a href="{{ url('/management-dashboard') }}" class="btn btn-secondary">Back to Dashboard</a>
    </div>
</div>
@endsection
