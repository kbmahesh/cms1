@extends('layouts.management')

@section('content')
<link rel="stylesheet" href="{{ asset('css/filter.css') }}">

<div class="container py-4">

    <form method="GET" action="{{ route('students.filter') }}" class="filter-container mb-4">

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
            <a href="{{ route('view-students') }}" class="btn btn-secondary">Reset</a>
        </div>

    </form>

    
    <div class="table-responsive mt-4">
        <table class="table table-bordered table-hover">
            <thead class="table-dark">
                <tr>
                    <th>Student ID</th>
                    <th>Name</th>
                    <th>Branch</th>
                    <th>Course</th>
                    <th>Semester</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($students as $student)
                    <tr>
                        <td>{{ $student->student_id }}</td>
                        <td>{{ $student->first_name }} {{ $student->last_name }}</td>
                        <td>{{ $student->academicDetails->Branch ?? 'N/A' }}</td>
                        <td>{{ $student->academicDetails->Course ?? 'N/A' }}</td>
                        <td>{{ $student->academicDetails->Semester ?? 'N/A' }}</td>
                        <td>
                            <a href="{{ route('students.view', $student->student_id) }}" class="btn btn-warning btn-sm">View</a>
                            <a href="{{ route('students.edit', $student->student_id) }}" class="btn btn-warning btn-sm">Update</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="action-buttons">
        <a href="{{ url('/management-dashboard') }}" class="btn btn-secondary">Back to Dashboard</a>
    </div>
</div>
@endsection
