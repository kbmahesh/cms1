@extends('layouts.management')
@section('content')
    <link rel="stylesheet" href="{{ asset('css/register.css') }}">
    <div class="container">
        <h2>Student Registration</h2>

        <!-- Student Personal Info -->
        <h3>Personal Info</h3>
        <!-- @if(session('success'))
            <script>
                alert("{{ session('success') }}");
            </script>
        @endif -->
        @if ($errors->any())
            <div class="warning-alert">
                <ul>
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </ul>
            </div>
        @endif

        <form id="studentForm" action="{{ route('students.store') }}" method="post">
            @csrf
            <div class="form-group">
                <label for="firstname">First Name:</label>
                <input type="text" id="first_name" name="first_name" placeholder='Enter student first name' required>
            </div>

            <div class="form-group">
                <label for="lastname">Last Name:</label>
                <input type="text" id="last_name" name="last_name" placeholder='Enter student last name' required>
            </div>

            <div class="form-group">
                <label for="gender">Gender:</label>
                <select id="gender" name="gender" required>
                    <option value="">Select Gender</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                </select>
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" placeholder='Enter student email' required>
            </div>

            <div class="form-group">
                <label for="student_id">Enter Student ID:</label>
                <input type="text" id="student_id" name="student_id" placeholder='Enter student id' required>
            </div>

            <div class="form-group">
                <label for="phone">Phone:</label>
                <input type="tel" id="phone" name="phone" placeholder='Enter phone number' required>
            </div>

            <div class="form-group">
                <label for="dob">Date of Birth:</label>
                <input type="date" id="dob" name="dob"  required>
            </div>

            <div class="form-group">
                <label for="address">Address:</label>
                <input type="text" id="address" name="address" placeholder='Enter address' required>
            </div>

            <h3>Academic Info</h3>

            <div class="form-group">
                <label for="course">Course</label>
                <select id="course" name="course" required>
                    <option value="">Select Course</option>
                    <option value="B.Tech">B.Tech</option>
                    <option value="M.Tech">M.Tech</option>
                </select>
            </div>

            <div class="form-group">
                <label for="branch">Select Branch:</label>
                <select id="branch" name="course_id" required>
                    <option value="">-- Select Branch --</option>
                </select>
            </div>

            <div class="form-group">
                <label for="semester">Semester</label>
                <input type="number" id="semester" name="semester" min="1" max="8" required>
            </div>
            <div class="form-group">
                <label for="admission_date">Admission Date</label>
                <input type="date" id="admission_date" name="admission_date" required>
            </div>

            <!-- Guardian Information -->
            <h3>Guardian's Information</h3>

            <div class="form-group">
                <label for="guardian_name">Guardian Name:</label>
                <input type="text" id="guardian_name" name="guardian_name" placeholder='Enter guardian name' required>
            </div>

            <div class="form-group">
                <label for="guardian_relation">Guardian Relationship:</label>
                <select id="guardian_relation" name="guardian_relation" required>
                    <option value="">Select Relationship</option>
                    <option value="Father">Father</option>
                    <option value="Mother">Mother</option>
                    <option value="Grandfather">Grandfather</option>
                    <option value="Grandmother">Grandmother</option>
                </select>
            </div>

            <div class="form-group">
                <label for="guardian_phone">Guardian Phone:</label>
                <input type="tel" id="guardian_phone" name="guardian_phone" placeholder='Enter guardian phone number' required>
            </div>

            <button type="submit" class="submit-btn">Register</button>
        </form>
    </div>
    <div class="action-buttons">
        <a href="{{ url('/management-dashboard') }}" class="btn btn-secondary">Back to Dashboard</a>
    </div>
    <script>
        document.getElementById("course").addEventListener("change", function () {
        let selectedCourse = this.value;
        let branchDropdown = document.getElementById("branch");

        branchDropdown.innerHTML = '<option value="">-- Select Branch --</option>'; // Reset options

        if (selectedCourse) {
            fetch(`/get-branches?course=${selectedCourse}`)
                .then(response => response.json())
                .then(data => {
                    data.forEach(course => {
                        let option = document.createElement("option");
                        option.value = course.CourseCode;
                        option.textContent = course.CourseName;
                        branchDropdown.appendChild(option);
                    });
                });
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