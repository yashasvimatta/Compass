<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Enrollment</title>
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
    <h2><i class="fas fa-users"></i> Course Enrollment</h2>

    <table id="customers" class="users-table">
    <thead>
                    <tr>
                        <th>Course Code</th>
                        <th>Course Name</th>
                        <th>Faculty/Instructor</th>
                        <th>Enrollment</th>
                    </tr>
                </thead>
        <tbody>
            @foreach ($courses as $course)
            <tr>
                <td>{{ $course->course_name}}</td>
                <td>{{ $course->course_code}}</td>
                <td>{{ $course->instructor->first_name }}</td>
                <td>
                    <button class="button button1" onclick="enroll('{{ route('enroll', ['course_id' => $course->id]) }}',{{$course->id}})">
                       Enroll
                    </button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
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

<script>
  function enroll(enrollUrl, courseId) {
    console.log(courseId)
    fetch(enrollUrl, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}', // Replace with the actual CSRF token
        },
        body: JSON.stringify({
            // If you need to send data with the POST request, include it here
        }),
    })
    .then(response => {
        if (response.ok) {
            // Enrollment was successful
            alert('Enrollment successful!');
            window.location.reload()
        } else {
            // Handle error response
            alert('Enrollment failed.');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('An error occurred while enrolling.');
    });
}
function hideEnrollButton(courseId) {
    const enrollButton = document.querySelector(`.enroll-button[data-course-id="${courseId}"]`);
    if (enrollButton) {
        enrollButton.style.display = 'none';
    }
}
</script>
