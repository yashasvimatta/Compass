<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course List</title>
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
    <h2><i class="fas fa-users"></i> Courses List</h2>

    <table id="customers" class="users-table">
    <thead>
                    <tr>
                        <th>Course Code</th>
                        <th>Course Name</th>
                        <th>Course Description</th>
                        <th>Action</th>
                    </tr>
                </thead>
        <tbody>
            @foreach ($courses as $course)
            <tr>
                <td>{{ $course->course_name}}</td>
                <td>{{ $course->course_code}}</td>
                <td>{{ $course->course_desc}}</td>
                <td>
                <button class="button button1" onclick="openEditModal({{ $course }})">
        Edit
    </button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div id="editModal" class="edit-form-container" style="display:none;">
    <span class="edit-header">Edit Course</span>
    <form action="{{ route('instructor.updatecourse')}}" method="POST">
        @csrf
        @method('PUT')
        <input type="hidden" id="id" name="id"/>
        <label for="courseName">Course Name:</label>
        <input type="text" id="course_name" name="course_name" value="{{ $course->course_name }}" required>

        <label for="courseCode">Course Code:</label>
        <input type="text" id="course_code" name="course_code" value="{{ $course->course_code }}" required>

        <label for="courseDesc">Course Description:</label>
        <textarea id="course_desc" name="course_desc" required>{{ $course->course_desc }}</textarea>

        <button type="submit" class="btn">Save Changes</button>
        <button type="button" class="btn cancel" onclick="closeEditModal()">Cancel</button>
    </form>
</div>
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
    document.addEventListener('DOMContentLoaded', function () {
        // Function to open the edit modal
        function openEditModal(course) {
            // Set course details in the modal
            document.getElementById('course_name').value = course.course_name;
            document.getElementById('id').value = course.id;
            document.getElementById('course_code').value = course.course_code;
            document.getElementById('course_desc').value = course.course_desc;
            document.getElementById('editModal').style.display = 'block';
        }

        // Function to close the edit modal
        function closeEditModal() {
            document.getElementById('editModal').style.display = 'none';
        }

        // Close the modal if the user clicks outside of it
        window.onclick = function (event) {
            var modal = document.getElementById('editModal');
            if (event.target == modal) {
                modal.style.display = 'none';
            }
        };

        // Assign the openEditModal and closeEditModal functions to the global scope
        window.openEditModal = openEditModal;
        window.closeEditModal = closeEditModal;
    });
</script>