<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>College Management System</title>

    <style>
        /* Universal Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            margin: 0;
            display: flex;
            flex-direction: column;
            height: 100vh;
            background-color: #f4f4f4;
        }

        header {
            background-color: #2196f3;
            color: #fff;
            padding: 15px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            font-size: 1.5rem;
            font-weight: bold;
        }

        nav {
            display: flex;
        }

        nav a {
            text-decoration: none;
            color: #fff;
            margin-left: 20px;
            padding: 10px 15px;
            border-radius: 5px;
            transition: background 0.3s;
        }

        nav a:hover {
            background: #1976d2;
            transform: scale(1.05);
        }

        .content {
            flex: 1;
            padding: 20px;
            overflow-y: auto;
        }

        .footer {
            background-color: #2196f3;
            color: #fff;
            text-align: center;
            padding: 10px 0;
            font-size: 0.9rem;
        }
    </style>
</head>
<body>

    <!-- Header with Navbar -->
    <header>
        <div class="logo">College Management System</div>
        <nav>
            <a href="{{ url('/personal-info') }}">Personal Info</a>
            <a href="{{ url('/academic-info') }}">Academic Info</a>
            <a href="{{ url('/fee-details') }}">Fee Details</a>
            <!-- <a href="{{ url('/courses') }}">Courses</a> -->
            <a href="{{ url('/transaction-history') }}">Transaction History</a>
            <!-- <a href="{{ url('/exams') }}">Exams</a> -->
            <a href="{{ route('logout') }}">Logout</a>
        </nav>
    </header>

    <!-- Main Content -->
    <div class="content">
        @yield('content') <!-- Child views will render content here -->
    </div>

    <!-- Footer -->
    <footer class="footer">
        &copy; {{ date('Y') }} College Management System. All rights reserved.
    </footer>

</body>
</html>
