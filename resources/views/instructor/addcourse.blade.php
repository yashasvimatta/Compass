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
    <h2>Add New Course</h2>
    <div class="center-container">
        <div>
     
            <form method="POST" action="/instructor/savecourse">
                @csrf
                <label for="course-id">Course Code:</label>
                <input type="text" id="course-id" name="course_name" >
                @error('course_name')
            <div class="error-message">{{ $message }}</div>
        @enderror
                <label for="course-name">Course Name:</label>
                <input type="text" id="course-name" name="course_code" >
                @error('course_code')
            <div class="error-message">{{ $message }}</div>
        @enderror
                <label for="course-description">Course Description:</label>
                <textarea id="course-description" name="course_desc" ></textarea>
                @error('course_desc')
            <div class="error-message">{{ $message }}</div>
        @enderror

                <button type="submit" id="submit" name="submit">Save Changes</button>
            </form>
        </div>

        @if (session('success'))
        <script>
            alert("{{ session('success') }}");
        </script>
        @endif

        @if (session('error'))
        <script>
            alert("{{ session('error') }}");
        </script>
        @endif
</section>
    </div>

    <footer class="footer">
        &copy; 2023 WDM Group 7 | <a class="footer_anchor" href="contactUs">Contact Us</a> | <a
            class="footer_anchor" href="aboutUs">About Us</a> | <a class="footer_anchor"
            href="services">Services</a>
    </footer>
</body>

</html>
