@extends('layouts.management')

@section('content')
<link rel="stylesheet" href="{{ asset('css/addfees.css') }}">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<div class="container">
        <div class="card">
            <h2>Fetch Student & Enter Fee</h2>
            <a class="btn" onclick="fetchStudent()">Fetch</a>
               <!-- Fee Details -->
               <form action="{{ route('submit.fee') }}" method="POST">
                @csrf
                <div class="input-group">
                    <label for="student_id">Enter Student ID:</label>
                    <div class="input-box">
                        <input type="text" id="student_id" name="student_id">
                    </div>
                </div>

                <!-- Student Details -->
                <div class="student-info">
                    <div class="info-box">
                        <label>Student Name:</label>
                        <span id="student_name">---</span>
                    </div>
                    <div class="info-box">
                        <label>Branch:</label>
                        <span id="branch">---</span>
                    </div>
                    <div class="info-box">
                        <label>Course:</label>
                        <span id="course">---</span>
                    </div>
                </div>

                <div class="input-group">
                    <label for="fee_category">Fee Type:</label>
                    <select id="fee_category" name="fee_category">
                        <option> Select Fee</option>
                        @foreach($feeTypes as $feeType)
                            <option value="{{ $feeType->fee_type_id }}">{{ $feeType->fee_name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="input-group">
                    <label for="amount">Fee Amount:</label>
                    <input type="number" id="amount" name="amount">
                </div>

                <div class="input-group">
                    <label for="due_date">Due Date:</label>
                    <input type="date" id="due_date" name="due_date">
                </div>

                <button type="submit" class="submit-btn" >Submit Fee</button>
            </form>
        </div>
        <div class="card cardb">
            <h2>Batch Wise Add Fee</h2>

            <div class="filters">
                <div class="filter-group">
                    <label for="branch">Select Branch:</label>
                    <select name="branch" id="branch" class="form-control">
                        <option value="">Select Branch</option>
                        @foreach($branches as $branch)
                            <option value="{{ $branch->Branch }}">{{ $branch->Branch }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="filter-group">
                    <label for="course">Select Course:</label>
                    <select name="course" id="course" class="form-control">
                        <option value="">Select Course</option>
                        @foreach($courses as $course)
                            <option value="{{ $course->Course }}">{{ $course->Course }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="filter-group">
                    <label for="semester">Select Semester:</label>
                    <select name="semester" id="semester" class="form-control">
                        <option value="">Select Semester</option>
                        @for($i = 1; $i <= 8; $i++)
                            <option value="{{ $i }}">Semester {{ $i }}</option>
                        @endfor
                    </select>
                </div>

                <button class="filter-btn" onclick="fetchStudents()">Filter Students</button>
            </div>

            <!-- Student List Appears Here -->
            <div class="student-list" id="studentList"></div>

            <div class="input-group">
                <label for="fee_category_batch">Fee Type:</label>
                <select id="fee_category_batch">
                    <option> Select Fee</option>
                    @foreach($feeTypes as $feeType)
                        <option value="{{ $feeType->fee_type_id }}">{{ $feeType->fee_name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="input-group">
                <label for="amount_batch">Enter Amount for All:</label>
                <input type="number" id="amount_batch" name="amount_batch" oninput="applyAmountToAll()">
            </div>

            <button class="submit-btn" onclick="submitBatchFee()">Submit Batch Fee</button>
        </div>
    </div>

    <script>
        function fetchStudent() {
            let studentId = $("#student_id").val();
            if (studentId) {
                $.ajax({
                    url: "/fetchStudent/" + studentId,
                    type: "GET",
                    success: function(response) {
                        if (response.success) {
                            $("#student_name").text(response.student.first_name + " " + response.student.last_name);
                            $("#branch").text(response.student.academic_details.Branch);
                            $("#course").text(response.student.academic_details.Course);
                        } else {
                            alert("Student not found!");
                        }
                    }
                });
            }
        }

        function fetchStudents() {
            let branch = document.getElementById("branch").value;
            let course = document.getElementById("course").value;
            let semester = document.getElementById("semester").value;

            if (!branch || !course || !semester) {
                alert("Please select all filters");
                return;
            }

            $.ajax({
                url: "/fetch-students",
                type: "GET",
                data: { branch, course, semester },
                success: function(response) {
                    let studentListDiv = document.getElementById("studentList");
                    studentListDiv.innerHTML = "";

                    if (response.students.length > 0) {
                        response.students.forEach(student => {
                            studentListDiv.innerHTML += `
                                <div class="student-item">
                                    <input type="checkbox" class="student-checkbox" value="${student.id}">
                                    <span>${student.name} (${student.id})</span>
                                    <input type="number" class="student-amount" placeholder="Enter Amount">
                                </div>
                            `;
                        });
                    } else {
                        studentListDiv.innerHTML = "<p>No students found</p>";
                    }
                }
            });

        }

        function applyAmountToAll() {
            let amount = document.getElementById("amount_batch").value;
            document.querySelectorAll(".student-amount").forEach(input => {
                input.value = amount;
            });
        }

        function submitBatchFee() {
            let selectedStudents = [];
            document.querySelectorAll(".student-checkbox:checked").forEach(checkbox => {
                let studentId = checkbox.value;
                let amount = checkbox.parentElement.querySelector(".student-amount").value;
                selectedStudents.push({ id: studentId, amount: amount });
            });

            if (selectedStudents.length === 0) {
                alert("Select at least one student");
                return;
            }

            let feeType = document.getElementById("fee_category_batch").value;

            $.ajax({
                url: "/submit-batch-fee",
                type: "POST",
                data: {
                    students: selectedStudents,
                    feeType: feeType,
                    _token: "{{ csrf_token() }}"
                },
                success: function(response) {
                    alert("Batch Fee Submitted Successfully");
                }
            });
        }   
        
        
    </script>
@endsection