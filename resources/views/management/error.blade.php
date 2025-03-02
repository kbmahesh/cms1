<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Failed</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            margin: 100px;
        }
        .error-box {
            border: 2px solid red;
            padding: 20px;
            display: inline-block;
            background-color: #ffe6e6;
        }
        a {
            text-decoration: none;
            font-weight: bold;
            color: blue;
        }
    </style>
</head>
<body>
    <div class="error-box">
        <h2>Student Registration Failed</h2>
        <p>{{ session('error') }}</p>
        <a href="{{ route('register') }}">Go Back to Registration</a>
    </div>
</body>
</html>
