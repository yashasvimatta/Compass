<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/instructor_dashboard.css') }}" /> 
    <link rel="stylesheet" type="text/css" href="{{ asset('css/admin.css') }}" /> 
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
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
    <h2><i class="fas fa-users"></i> Assignments</h2>
    <table id="customers" class="users-table">
    <thead>
                    <tr>
                        <th>Title</th>
                        <th>Desciption</th>
                        <th>Due Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
        <tbody>
            @foreach ($assignments as $course)
            <tr>
                <td>{{ $course->title}}</td>
                <td>{{ $course->description}}</td>
                <td>{{ $course->due_date}}</td>
                <td>
                <a href="{{ asset('storage/' . $course->file_path) }}" class="button button1" download>
                    Download
                </a>
                @if (strtotime($course->due_date) < strtotime(now()))
                    <button class="button button1" disabled data-toggle="tooltip" data-placement="top" title="Assignment Due Date has passed.">
                        Submit
                    </button>
                @else
                    <button class="button button1" onclick="submitAssignment({{ $course }})">
                        Submit
                    </button>
                @endif
            </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div id="editModal" class="edit-form-container" style="display:none;">
    <span class="edit-header">Submit Assignment</span>
    <form action="{{ route('student.upload')}}" method="POST"  enctype="multipart/form-data">
        @csrf
        @method('POST')
        <input type="hidden" id="assignment_id" name="assignment_id"/>
        <label for="file">File:</label>
        <input type="file" id="file" name="file" required>
        <button type="submit" class="btn">Save Changes</button>
        <button type="button" class="btn cancel" onclick="closeEditModal()">Cancel</button>
    </form>
</div>
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

<script>
     function submitAssignment(course) {
            document.getElementById('assignment_id').value = course.id;
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
    //     $(document).ready(function () {
    //     // Initialize Bootstrap Tooltip
    //     $('[data-toggle="tooltip"]').tooltip();
    // });

</script>