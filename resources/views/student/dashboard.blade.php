<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/instructor_dashboard.css') }}" /> 
    <link rel="stylesheet" type="text/css" href="{{ asset('css/admin.css') }}" /> 
</head>
<style>
    .container {
    padding-top: 20px;
}

.box {
    border: 1px solid #ddd;
    margin-bottom: 20px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.box-content {
    padding: 20px;
}

h3 {
    color: #333;
}

.button-container {
    margin-top: 15px;
}

.button {
    display: inline-block;
    padding: 8px 16px;
    margin-right: 10px;
    border: none;
    cursor: pointer;
    color: #fff;
    border-radius: 4px;
}

.button-syllabus {
    background-color: #3498db;
}

.button-assignment {
    background-color: #2ecc71;
}

.button-grade {
    background-color: #e74c3c;
}

.row {
    margin-left: -15px;
    margin-right: -15px;
}

.col-lg-4 {
    width: 25%;
    padding-left: 15px;
    padding-right: 15px;
    float: left;
    position: relative;
}
    </style>
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
   
    <div class="container" style="width:50%">
    <div class="row">
        @foreach ($courses as $course)
            <div class="col-lg-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">{{ $course->course_code }} {{ $course->course_name }}</h5>
                        <div class="button-container">
                            <button class="btn btn-primary" onclick="document.location='syllabusstudent'">Syllabus</button>
                            <button class="btn btn-success" onclick="document.location='/student/getassignmentbycourse/{{ $course->id }}'">Assignments</button>
                            <!-- <button class="btn btn-danger" onclick="document.location='/student/getCourseInformationForUser/{{ $course->id }}'">Grades</button> -->
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    </section>
</div>
</div>
</div>


   

    <footer class="footer">
        &copy; 2023 WDM Group 7 | <a class="footer_anchor" href="contactUs">Contact Us</a> | <a
            class="footer_anchor" href="aboutUs">About Us</a> | <a class="footer_anchor"
            href="services">Services</a>
    </footer>
</body>
</html>
