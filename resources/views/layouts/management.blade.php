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
                align-items: center;
            }

            nav a, .dropdown-content a {
                text-decoration: none;
                color: #fff;
                padding: 10px 15px;
                border-radius: 5px;
                display: block;
                transition: background 0.3s, transform 0.3s ease;
            }

            nav a:hover, .dropdown-content a:hover {
                background: #1976d2;
                transform: scale(1.05);
            }

            /* Dropdown Container */
            .dropdown {
                position: relative;
                display: inline-block;
            }

            .dropdown-content {
                display: none;
                position: absolute;
                background-color: #2196f3;
                min-width: 160px;
                z-index: 1;
                border-radius: 10px;
                opacity: 0;
                visibility: hidden;
                transform: translateY(-10px);
                transition: opacity 0.3s, visibility 0.3s, transform 0.3s;
            }

            .dropdown:hover .dropdown-content {
                display: block;
                opacity: 1;
                visibility: visible;
                transform: translateY(0);
            }

            .dropdown:hover .dropbtn {
                background-color: #1976d2;
            }

            /* Content Styles */
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

            /* Table Styles */
            table {
                width: 100%;
                border-collapse: collapse;
                margin-top: 20px;
            }

            table, th, td {
                border: 1px solid #ddd;
            }

            th, td {
                padding: 12px;
                text-align: center;
            }

            th {
                background-color: #2196f3;
                color: white;
            }

            td {
                background-color: #fff;
            }

            .btn {
                text-decoration: none;
                background-color: #4caf50;
                padding: 10px 20px;
                color: white;
                border-radius: 5px;
                display: inline-block;
            }

            .btn:hover {
                background-color: #388e3c;
            }

            .danger {
                background-color: #f44336;
            }

            .danger:hover {
                background-color: #d32f2f;
            }
        </style>
    </head>
    <body>

        <!-- Header with Navbar -->
        <header>
            <div class="logo">College Management System</div>
            <nav>
                <!-- Student Registration Dropdown -->
                <div class="dropdown">
                    <a href="#" class="dropbtn">Student Management</a>
                    <div class="dropdown-content">
                        <a href="{{ url('/register') }}">Register Student</a>
                        <a href="{{ url('/view-students') }}">View All Students</a>
                    </div>
                </div>

                <!-- Fee Management Dropdown -->
                <div class="dropdown">
                    <a href="#" class="dropbtn">Fee Management</a>
                    <div class="dropdown-content">
                        <a href="{{ url('/fees') }}">View Fees</a>
                        <a href="{{ url('/add') }}">Add Fee Payment</a>
                        <a href="{{ url('/pending') }}">Verify Receipts</a>
                    </div>
                </div>

                <!-- Reports Dropdown -->
                <!-- <div class="dropdown">
                    <a href="#" class="dropbtn">Reports</a>
                    <div class="dropdown-content">
                        <a href="{{ url('/student-reports') }}">Student Reports</a>
                        <a href="{{ url('/financial-reports') }}">Financial Reports</a>
                    </div>
                </div> -->

                <!-- Settings Dropdown -->
                <!-- <div class="dropdown">
                    <a href="#" class="dropbtn">Settings</a>
                    <div class="dropdown-content">
                        <a href="{{ url('/college-settings') }}">College Settings</a>
                        <a href="{{ url('/course-management') }}">Manage Courses</a>
                        <a href="{{ url('/department-management') }}">Manage Departments</a>
                    </div>
                </div> -->

                <form id="logout-form" action="{{ route('management.logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>

                <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    Logout
                </a>

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
