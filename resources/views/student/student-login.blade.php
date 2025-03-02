<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Login</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <div class="clg-name">
        <div class="logo">
            <img class="logo-img" src="{{ asset('images/logo.jpg') }}" alt="">
        </div>
        <div class="clg">
            <h2>JNTUA College of Engineering (Autonomous) Ananthapur</h2>
            <h4>Sir Mokshagundam Vishveshwariah Road, Ananthapuramu, Andhra Pradesh-515002, INDIA</h4>
            <h4>An ISO 9001:2015 Certified Institution</h4>
        </div>
        <div class="logo">
            <img class="logo-img" src="{{ asset('images/NAAC.jpg') }}" alt="">
        </div>
    </div>
    <div class="container">
        <h2>Student Login</h2>
        @if(session('error'))
            <p class="alert">
                {{ session('error') }}
            </p>
        @endif
        <form action="{{ route('student.authenticate') }}" method="POST">
            @csrf <!-- Protects the form from CSRF attacks -->
            <div class="form-group">
                <label for="student-id">Student ID:</label>
                <input type="text" id="student-id" name="student-id" required placeholder="Enter your student ID">
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required placeholder="Enter your password">
            </div>
            <button type="submit">Login</button>
        </form>
    </div>
</body>
</html>
