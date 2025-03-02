@extends('layouts.student')

@section('content')
    <!-- Link the personal-info-specific CSS -->
    <link rel="stylesheet" href="{{ asset('css/personal-info.css') }}">

    <h1>Personal Information</h1>

    <div class="info-container">
        <!-- Personal Info Display -->
        <div class="info-card summary-card">
            <h3>Your Personal Info</h3>
            <div class="personal-info">
                <p><strong>Name:</strong> {{ $student->first_name }} {{$student->last_name}}</p>
                <p><strong>Email:</strong> {{ $student->email }}</p>
                <p><strong>Student ID:</strong> {{ $student->student_id }}</p>
                <p><strong>Phone:</strong> {{ $student->phone }}</p>
                <p><strong>Date of Birth:</strong> {{ $student->dob }} </p>
                <p><strong>Address:</strong> {{ $student->address }}</p>
            </div>
        </div>

        <!-- Guardian Info Display -->
        <div class="info-card guardian-card">
            <h3>Guardian's Information</h3>
            <div class="guardian-info">
                <p><strong>Guardian Name:</strong> {{ $guardians->guardian_name }}</p>
                <p><strong>Guardian Relationship:</strong> {{ $guardians->relationship }}</p>
                <p><strong>Guardian Phone:</strong> {{ $guardians->phone }}</p>
                <p><strong>Guardian Email:</strong> {{ $guardians->email }}</p>
                <p><strong>Guardian Address:</strong> {{ $guardians->address }}</p>
            </div>
        </div>
    </div>

    <div class="action-buttons">
        <a href="{{ url('/student-dashboard') }}" class="btn btn-secondary">Back to Dashboard</a>
    </div>
@endsection
