@extends('layouts.management')

@section('content')
<link rel="stylesheet" href="{{ asset('css/register.css') }}">
<div class="container">
    <h2 class="mb-4">Update Student Details</h2>
    
    <form id="studentForm" action="{{ route('students.update', $student->student_id) }}" method="POST">
        @csrf
        @method('PUT') <!-- Laravel method spoofing for PUT request -->
        
        <div class="form-group">
            <label for="student_id" class="form-label">Student ID</label>
            <input type="text" name="student_id" class="form-control" value="{{ old('student_id', $student->student_id) }}" readonly>
        </div>

        <div class="form-group">
            <label for="first_name" class="form-label">First Name</label>
            <input type="text" name="first_name" class="form-control" value="{{ old('first_name', $student->first_name) }}" required>
        </div>

        <div class="form-group">
            <label for="last_name" class="form-label">Last Name</label>
            <input type="text" name="last_name" class="form-control" value="{{ old('last_name', $student->last_name) }}" required>
        </div>

        <div class="form-group">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" class="form-control" value="{{ old('email', $student->email) }}" required>
        </div>

        <div class="form-group">
            <label for="phone" class="form-label">Phone</label>
            <input type="text" name="phone" class="form-control" value="{{ old('phone', $student->phone) }}" required>
        </div>

        <div class="form-group">
            <label for="dob" class="form-label">Date of Birth</label>
            <input type="date" name="dob" class="form-control" value="{{ old('dob', $student->dob) }}" required>
        </div>

        <div class="form-group">
            <label for="address" class="form-label">Address</label>
            <input type="text" name="address" class="form-control" value="{{ old('address', $student->address) }}" required>
        </div>

        <div class="form-group">
            <label for="course" class="form-label">Course</label>
            <select name="course" id="course" class="form-control">
                <option value="">Select Course</option>
                <option value="B.Tech" {{ old('course', $student->academicDetails->Course ?? '') == 'B.Tech' ? 'selected' : '' }}>B.Tech</option>
                <option value="M.Tech" {{ old('course', $student->academicDetails->Course ?? '') == 'M.Tech' ? 'selected' : '' }}>M.Tech</option>
            </select>
        </div>

        <div class="form-group">
            <label for="branch" class="form-label">Branch</label>
            <select name="branch" id="branch" class="form-control">
            
            </select>
        </div>

        <div class="form-group">
            <label for="semester" class="form-label">Semester</label>
            <select name="semester" class="form-control">
                @for($i = 1; $i <= 8; $i++)
                    <option value="{{ $i }}" {{ $student->academicDetails->Semester == $i ? 'selected' : '' }}>
                        Semester {{ $i }}
                    </option>
                @endfor
            </select>
            </div>

        <div class="form-group">
            <label for="guardian_name" class="form-label">Guardian Name</label>
            <input type="text" name="guardian_name" class="form-control" value="{{ old('guardian_name', $student->guardians->guardian_name) }}" required>
        </div>

        <div class="form-group">
            <label for="guardian_relation">Guardian Relationship:</label>
            <select id="guardian_relation" name="guardian_relation" required>
                <option value="">Select Relationship</option>
                <option value="Father" {{ old('guardian_relation', $student->guardians->relationship ?? '') == 'Father' ? 'selected' : '' }}>Father</option>
                <option value="Mother" {{ old('guardian_relation', $student->guardians->relationship ?? '') == 'Mother' ? 'selected' : '' }}>Mother</option>
                <option value="Grandfather" {{ old('guardian_relation', $student->guardians->relationship ?? '') == 'Grandfather' ? 'selected' : '' }}>Grandfather</option>
                <option value="Grandmother" {{ old('guardian_relation', $student->guardians->relationship ?? '') == 'Grandmother' ? 'selected' : '' }}>Grandmother</option>
            </select>
        </div>

        <div class="form-group">
            <label for="guardian_phone" class="form-label">Guardian Phone</label>
            <input type="text" name="guardian_phone" class="form-control" value="{{ old('guardian_phone', $student->guardians->phone) }}" required>
        </div>

        <div class="buttons">
            <button type="submit" class="submit-btn">Update Student</button>
            <a href="{{ route('view-students') }}" class="btn btn-secondary">Cancel</a>
        </div>    
    </form>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        let courseDropdown = document.getElementById('course');
        let branchDropdown = document.getElementById('branch');

        // Function to fetch and update branches
        function loadBranches(courseCode) {
            if (courseCode) {
                fetch(`/get-branches?course=${courseCode}`)
                    .then(response => response.json())
                    .then(data => {
                        console.log(data);
                        branchDropdown.innerHTML = '<option value="">Select Branch</option>';
                        data.forEach(branch => {
                            let selected = "{{ old('branch', $student->academicDetails->Branch ?? '') }}" === branch.CourseCode ? 'selected' : '';
                            branchDropdown.innerHTML += `<option value="${branch.CourseCode}" ${selected}>${branch.CourseName}</option>`;
                        });
                    })
                    .catch(error => console.error('Error fetching branches:', error));
            } else {
                branchDropdown.innerHTML = '<option value="">Select Branch</option>';
            }
        }

        // Load branches when the course is changed
        courseDropdown.addEventListener('change', function () {
            loadBranches(this.value);
        });

        // Load branches on page load (for editing an existing student)
        let existingCourseCode = courseDropdown.value;
        if (existingCourseCode) {
            loadBranches(existingCourseCode);
        }
    });
    document.getElementById('studentForm').addEventListener('submit', function(event) {
        let confirmSubmission = confirm("Are you sure you want to submit the form?");
        if (!confirmSubmission) {
            event.preventDefault(); // Stop form submission if user cancels
        }
    });
</script>

@endsection
