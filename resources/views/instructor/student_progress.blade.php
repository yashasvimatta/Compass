<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Progress</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/instructor_dashboard.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/admin.css') }}" />
</head>

<body>
    <header class="header">
        <div class="logo_navbar">
            <h2 class="logo_heading">Course Compass | Instructor</h2>
        </div>
        <div class="header-right">
            <a class="logout-heading" href="{{ url('logout') }}">Logout</a>
        </div>
    </header>
    <div class="dashboard-container">
    @include('instructor.sidebar') 

        <section class="performance_data second-section">
    <h2><i class="fas fa-users"></i> Student Progress</h2>

    <table id="customers" class="users-table">
    <thead>
        <tr>
            <th>Student Name</th>
            <th>Course Name</th>
            <th>Total Marks</th>
        </tr>
    </thead>
    <tbody>
        @foreach($studentProgressData as $data)
            <tr>
                <td>{{ $data['student_name'] }}</td>
                <td>{{ $data['course_name'] }}</td>
                <td>{{ $data['total_marks'] }}</td>
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
