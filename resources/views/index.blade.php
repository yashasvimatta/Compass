<!-- resources/views/homepage.blade.php -->

@php
    // Session::start(); // Uncomment this if needed
    $userRole = isset($_COOKIE['user_role']) ? $_COOKIE['user_role'] : null;
@endphp

@if ($userRole)
    <script>
        @switch($userRole)
            @case('student')
                location.replace("dashboard-student.php");
                @break
            @case('instructor')
                location.replace("instructor_dashboard.php");
                @break
            @case('Quality_Assurance')
                location.replace("quality_qao1.php");
                @break
            @case('Program_Coordinator')
                location.replace("program_coordinator.php");
                @break
            @case('admin')
                location.replace("admin.php");
                @break
        @endswitch
    </script>
@else
    <script>
        // alert("Please Login");
    </script>
@endif

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course Compass | Homepage</title>
    <link rel="stylesheet" href="{{ asset('css/homepage.css') }}">
</head>

<body>
    <header>
        <h1>Course Compass</h1>
        <h4><a class="footer_anchor" href="login">Login</a></h4>
    </header>

    <main>
        <div class="homepagecontent">
            <p>
                Welcome to the MSC in Computer Science program,
                where innovation meets excellence. Explore the world
                of cutting-edge technology and prepare for a
                rewarding career in the digital age.
                <br><br>

                Our academic program aims to nurture knowledge
                acquisition, critical thinking, research, and ethical
                values among students. Performance measurement
                and assessment play a crucial role in enhancing
                accountability, customizing learning, ensuring quality,
                and preparing graduates for successful careers in a
                globally interconnected world
            </p>
            <div class="image-and-button">
                <img src="{{ asset('images/Homepage.jpg') }}" alt="Girl with a Laptop" class="homepageImage">
                <button class="homepageButton"><a class="footer_anchor" href="signup">JOIN NOW!</a></button>
            </div>
        </div>
    </main>

    <footer>
        &copy; 2023 WDM Group 7 | <a class="footer_anchor" href="contactUs">Contact Us</a> |
        <a class="footer_anchor" href="aboutUs">About Us</a> |
        <a class="footer_anchor" href="services">Services</a>
    </footer>
</body>

</html>
