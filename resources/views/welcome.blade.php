<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>College Management System</title>
    <link rel="stylesheet" href="{{ asset('css/style.css')}}">
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
    <div class="welcome">
        <h1>Welcome to the JNTUA</h1>
        <p>Please select your login type:</p>
        <div class="buttons">
            <a href="{{ url('/management-login') }}">Management Login</a>
            <a href="{{ url('/student-login') }}">Student Login</a>
        </div>
    </div>
</body>
</html>
