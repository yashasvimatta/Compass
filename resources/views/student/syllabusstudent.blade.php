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
.syllabus {
  margin-left: 14%;
  margin-top: 3%;
  margin-right: -5%;
}

    </style>
<body>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
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
   
    <div class="embed-responsive embed-responsive-16by9">
    <iframe class="embed-responsive-item syllabus"
            src="https://oit-ead-canvas-syllabus.s3.amazonaws.com/uta.instructure.com/2023-FALL/155704-2238-CSE-5334-004/2023-FALL_2238-CSE-5334-004.pdf"
            allowfullscreen></iframe>
</div>
</section>
</div>
    <footer class="footer">
        &copy; 2023 WDM Group 7 | <a class="footer_anchor" href="contactUs">Contact Us</a> | <a
            class="footer_anchor" href="aboutUs">About Us</a> | <a class="footer_anchor"
            href="services">Services</a>
    </footer>
</body>
</html>
