

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Instructor Dashboard</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/instructor_dashboard.css') }}" />
    <style>
        footer {
            background-color: #2c3e50;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            color: white;
            text-align: center;
            padding: 10px;
            position: fixed;
            left: 0;
            bottom: 0;
            height: 60px;
            width: 100%;
        }
    </style>
</head>

<body>
    <div id="navbar">
        <a href="#default" id="logo">Course Compass | Instructor</a>
        <div id="navbar-right">
            <a href="{{ url('logout') }}">Logout</a>
        </div>
    </div>

    <div id="mySidenav" class="sidenav">
        <a class="active" href="{{ url('instructor_dashboard') }}">Dashboard</a>
        <a href="{{ url('instructor_course') }}">Create Course</a>
        <a href="{{ url('instructor_managecourses') }}">Manage Courses</a>
        <!--<a href="{{ url('instructor_info') }}">Personal Information</a>-->
        <a href="{{ url('instructor_feedback') }}">Feedback</a>
        <a href="{{ url('instructor_marks') }}">Assign Marks</a>
        <a href="{{ url('instructor_progress') }}">Student Progress</a>
        <a href="{{ url('instructor_assignment') }}">Assignment</a>
    </div>

    @foreach($courses as $course)
    <ul class="course-list">
        <li class="course-item">
            <div>
                <h6>Course ID: {{ $course->course_id }}</h6>
            </div>
            <h3>{{ $course->branch_name }} {{ $course->course_code }} {{ $course->course_name }}</h3>
            <p>{{ $course->course_desc }}</p>
        </li>
    </ul>
    @endforeach

    <button class="open-button" onclick="openForm()">Chat</button>

    <form action="" class="form-container" method="POST">
        @csrf
        <h1>Chat</h1>
        <label for="msg"><b>{{ $chatMessage ?? 'Type your message' }}</b></label>
        <textarea placeholder="Type message.." name="msg" required></textarea>
        <button type="submit" class="btn" name="submit">Send</button>
        <button type="button" class="btn cancel" onclick="closeForm()">Close</button>
    </form>

    <footer>
        &copy; 2023 WDM Group 7
    </footer>

    <script>
        function openForm() {
            document.getElementById("myForm").style.display = "block";
        }

        function closeForm() {
            document.getElementById("myForm").style.display = "none";
        }
    </script>
</body>

</html>
