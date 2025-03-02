@extends('layouts.student')

@section('content')
    <!-- Link the dashboard-specific styles (your separate CSS file) -->
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">

    <div class="dashboard-container">
        <!-- Header Section -->
        <div class="dashboard-header">
            <h1>Student Dashboard</h1>
        </div>

        <!-- Overview Section -->
        <div class="overview-stats">
            <div class="stat-card">
                <h3>Academic Status</h3>
                <p><strong>GPA:</strong> 3.85</p>
                <p><strong>Current Semester:</strong> 6th</p>
                <p><strong>Courses Enrolled:</strong> 5</p>
            </div>
            <div class="stat-card">
                <h3>Financial Status</h3>
                <p><strong>Total Fees Paid:</strong> ₹{{$feeDetails[0]->total_paid ?? 'N/A' }}</p>
                <p><strong>Pending Amount:</strong> ₹{{$feeDetails[0]->overdue_total ?? 'N/A' }}</p>
                <p><a href="{{ url('/fee-details') }}">View Details</a></p>
            </div>
            <div class="stat-card">
                <h3>Upcoming Exams</h3>
                <p><strong>Math:</strong> Feb 15, 2025</p>
                <p><strong>Physics:</strong> Feb 18, 2025</p>
                <p><a href="{{ url('/exams') }}">View Schedule</a></p>
            </div>
        </div>

        <!-- Notifications Section -->
        <div class="notifications">
            <h2>Notifications</h2>
            <ul>
                <li><strong>Jan 25, 2025:</strong> Timetable for Semester 6 has been updated. <a href="{{ url('/timetable') }}">View Timetable</a></li>
                <li><strong>Jan 20, 2025:</strong> Fee payment deadline is approaching. <a href="{{ url('/fee-details') }}">Pay Now</a></li>
                <li><strong>Jan 15, 2025:</strong> Results for Semester 5 have been published. <a href="{{ url('/academic-info') }}">Check Results</a></li>
            </ul>
        </div>

        <!-- Quick Links Section -->
        <div class="quick-links">
            <h2>Quick Links</h2>
            <div class="links">
                <a href="{{ url('/personal-info') }}">Personal Info</a>
                <a href="{{ url('/academic-info') }}">Academic Info</a>
                <a href="{{ url('/fee-details') }}">Fee Details</a>
                <a href="{{ url('/timetable') }}">Timetable</a>
                <a href="{{ url('/transaction-history') }}">Transaction History</a>
                <a href="{{ url('/exams') }}">Exams</a>
            </div>
        </div>
    </div>
@endsection
