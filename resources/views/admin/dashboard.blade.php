
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" type="text/css"  href="{{ asset('css/admin.css') }}" />
    <style>
        #operApprove {
            margin-right: 250px;
            text-align: left;
        }

        #openReject {
            margin-right: 250px;
            text-align: left;
        }

        .editHeader {
            text-align: center;
        }

        /* Add styles to the form container */
        .edit-form-container {
            max-width: 300px;
            padding: 10px;
            background-color: white;
            max-height: 50%;
        }

        /* Full-width input fields */
        .edit-form-container input[type=text],
        .edit-form-container input[type=password],
        input[type=number],
        input[type=email] {
            width: 100%;
            padding: 15px;
            margin: 5px 0 22px 0;
            border: none;
            background: #f1f1f1;
        }

        /* When the inputs get focus, do something */
        .edit-form-container input[type=text]:focus,
        .edit-form-container input[type=password]:focus {
            background-color: #ddd;
            outline: none;
        }

        textarea {
            width: 100%;
            padding: 15px;
            margin: 5px 0 22px 0;
            border: none;
            background: #f1f1f1;
        }

        /* When the textarea gets focus, do something */
        .edit-form-container textarea:focus {
            background-color: #ddd;
            outline: none;
        }

        /* Set a style for the submit/send button */
        .edit-form-container .btn {
            background-color: #4e6783;
            color: white;
            padding: 16px 20px;
            border: none;
            cursor: pointer;
            width: 100%;
            margin-bottom: 10px;
            opacity: 0.8;
        }

        /* Add a red background color to the cancel button */
        .edit-form-container .cancel {
            background-color: rgb(24, 22, 22);
        }

        /* Add some hover effects to buttons */
        .edit-form-container .btn:hover,
        .open-button:hover {
            opacity: 1;
        }
    </style>
</head>

<body>
<div class="page-wrapper">

    <header class="header">
        <div class="logo_navbar">
            <h2 class="logo_heading">Course Compass | Admin</h2>
        </div>
        <div class="header-right">
            <a class="logout-heading" href="{{ url('logout') }}">Logout</a>
        </div>
    </header>

    <div class="dashboard-container">
        

        @include('admin.sidebar') 

        <section class="dashboard second-section">
        <div class="dashboard-header">
            <h2>Dashboard</h2>
        </div>

        <div class="performance-metrics">
            <div class="metric">
                <h3>Total Users</h3>
                <p>{{ $totalUsers }}</p>
            </div>

            <div class="metric">
                <h3>Total Courses</h3>
                <p>{{ $totalCourses }}</p>
            </div>
        </div>

        <div class="performance-metrics">
            <div class="metric">
                <h3>Total Students</h3>
                <p>{{ $totalStudents }}</p>
            </div>

            <div class="metric">
                <h3>Total Instructors</h3>
                <p>{{ $totalInstructors }}</p>
            </div>
        </div>

        <div class="performance-metrics">
            <div class="metric">
                <h3>Total QAO</h3>
                <p>{{ $totalQAO }}</p>
            </div>

            <div class="metric">
                <h3>Total Program Coordinators</h3>
                <p>{{ $totalProgramCoordinators }}</p>
            </div>
        </div>
        </section>
    </div>
    </div>

    <footer class="footer">
        &copy; 2023 WDM Group 7 | <a class="footer_anchor" href="contactUs">Contact Us</a> | <a
            class="footer_anchor" href="aboutUs">About Us</a> | <a class="footer_anchor"
            href="services">Services</a>
    </footer>
</div>
</body>

</html>