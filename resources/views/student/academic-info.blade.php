@extends('layouts.student')

@section('content')
    <!-- Link the academic-info-specific CSS -->
    <link rel="stylesheet" href="{{ asset('css/academic-info.css') }}">

    <h1>Academic Information</h1>

    <div class="info-container">
        <!-- Course Info Card -->
        <div class="info-card academic-card">
            <h3>Course Information</h3>
            <div class="academic-info">
                <p><strong>Course Name:</strong> Computer Science</p>
                <p><strong>Course Code:</strong> CS101</p>
                <p><strong>Year of Study:</strong> 2nd Year</p>
                <p><strong>Enrollment Status:</strong> Active</p>
            </div>
        </div>

        <!-- Marks Info Card -->
        <div class="info-card academic-card">
            <h3>Marks Summary</h3>
            <div class="marks-info">
                <p><strong>Semester 1:</strong> 85%</p>
                <p><strong>Semester 2:</strong> 88%</p>
                <p><strong>CGPA:</strong> 3.7</p>
            </div>
        </div>

        <!-- Subjects Info Card -->
        <div class="info-card academic-card">
            <h3>Subjects</h3>
            <div class="subjects-info">
                <ul>
                    <li>Data Structures</li>
                    <li>Algorithms</li>
                    <li>Database Management</li>
                    <li>Operating Systems</li>
                </ul>
            </div>
        </div>
    </div>

    <div class="action-buttons">
        <a href="{{ url('/student-dashboard') }}" class="btn btn-secondary">Back to Dashboard</a>
    </div>
@endsection
