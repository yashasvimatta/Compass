<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Grades</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/instructor_dashboard.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/admin.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/student.css') }}" />
</head>

<body>
    <header class="header">
        <div class="logo_navbar">
            <h2 class="logo_heading">Course Compass | Student</h2>
        </div>
        <div class="header-right">
            <a class="logout-heading" href="{{ url('logout') }}">Logout</a>
        </div>
    </header>
    <div class="dashboard-container">
    @include('student.sidebar') 

        <section class="performance_data second-section">
    <h2><i class="fas fa-users"></i> Grades</h2>

    <table id="customers" class="users-table">
    <thead>
                    <tr>
                        <th>Course Name</th>
                        <th>Total Marks</th>
                        <th>Obtained Marks</th>
                        <th>Grade</th>
                    </tr>
                </thead>
        <tbody>
            @foreach ($courses as $course)
            <tr>
                <td>{{ $course->course_name}}</td>
                <td>{{ $course->totalmarks}}</td>
                <td>{{ $course->obtainedmarks }}</td>
                <td>{{ $course->grade }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
        </section>
    </div>
    </div>

    <footer class="footer">
        &copy; 2023 WDM Group 7 | <a class="footer_anchor" href="contactUs">Contact Us</a> | <a
            class="footer_anchor" href="aboutUs">About Us</a> | <a class="footer_anchor"
            href="services">Services</a>
    </footer>
</body>

</html>
