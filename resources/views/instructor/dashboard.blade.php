<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Instructor Dashboard</title>
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
    <ul class="course-list">
    @foreach ($courses as $course)
    <li class="course-item">
        <div>
            <h6>Course ID: {{ $course->id}}</h6>
        </div>
        <h3>{{ $course->course_name}} {{ $course->course_name}}</h3>
        <p>{{ $course->course_desc}}</p>
    </li>
    @endforeach
   
</ul>
</section>
</div>
    <footer class="footer">
        &copy; 2023 WDM Group 7 | <a class="footer_anchor" href="contactUs">Contact Us</a> | <a
            class="footer_anchor" href="aboutUs">About Us</a> | <a class="footer_anchor"
            href="services">Services</a>
    </footer>
</body>
</html>
