<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Feedback</title>
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
    <h2><i class="fas fa-users"></i> Feedback</h2>

    <div class="container" style="width:50%">
        <form action="{{ route('feedbackstore') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="feedback_for">Feedback For Instructor:</label>
                <select name="feedback_for" id="feedback_for" class="form-control">
                    @foreach($users as $user)
                        <option value="{{ $user->id }}">{{ $user->first_name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="feedback">Feedback:</label>
                <textarea name="feedback" id="feedback" class="form-control" rows="3"></textarea>
            </div>

            <div class="form-group">
                <label for="subject">Subject:</label>
                <input type="text" name="subject" id="subject" class="form-control">
            </div>

            <button type="submit" class="btn btn-primary">Submit Feedback</button>
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
    </div>

    <footer class="footer">
        &copy; 2023 WDM Group 7 | <a class="footer_anchor" href="contactUs">Contact Us</a> | <a
            class="footer_anchor" href="aboutUs">About Us</a> | <a class="footer_anchor"
            href="services">Services</a>
    </footer>
</body>

</html>
