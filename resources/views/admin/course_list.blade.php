
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Courses List</title>
    <link rel="stylesheet" type="text/css"  href="{{ asset('css/admin.css') }}" />
    <style>
        #operApprove {
            margin-right: 250px;
            text-align: left;
        }

        #openReject {
            margin-right: 250px;
            text-align: left;
        }

        .editHeader {
            text-align: center;
        }

        /* Add styles to the form container */
        .edit-form-container {
            max-width: 300px;
            padding: 10px;
            background-color: white;
            max-height: 50%;
        }

        /* Full-width input fields */
        .edit-form-container input[type=text],
        .edit-form-container input[type=password],
        input[type=number],
        input[type=email] {
            width: 100%;
            padding: 15px;
            margin: 5px 0 22px 0;
            border: none;
            background: #f1f1f1;
        }

        /* When the inputs get focus, do something */
        .edit-form-container input[type=text]:focus,
        .edit-form-container input[type=password]:focus {
            background-color: #ddd;
            outline: none;
        }

        textarea {
            width: 100%;
            padding: 15px;
            margin: 5px 0 22px 0;
            border: none;
            background: #f1f1f1;
        }

        /* When the textarea gets focus, do something */
        .edit-form-container textarea:focus {
            background-color: #ddd;
            outline: none;
        }

        /* Set a style for the submit/send button */
        .edit-form-container .btn {
            background-color: #4e6783;
            color: white;
            padding: 16px 20px;
            border: none;
            cursor: pointer;
            width: 100%;
            margin-bottom: 10px;
            opacity: 0.8;
        }

        /* Add a red background color to the cancel button */
        .edit-form-container .cancel {
            background-color: rgb(24, 22, 22);
        }

        /* Add some hover effects to buttons */
        .edit-form-container .btn:hover,
        .open-button:hover {
            opacity: 1;
        }
        /* Add styles to the form container */
.edit-form-container {
    max-width: 400px;
    padding: 20px;
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    display: none; /* Hide the modal by default */
}

.edit-header {
    font-size: 20px;
    font-weight: bold;
    margin-bottom: 20px;
}

/* Full-width input fields */
.edit-form-container input[type=text],
.edit-form-container textarea {
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
}

/* Set a style for the submit/send button */
.edit-form-container .btn {
    background-color: #4e6783;
    color: white;
    padding: 12px 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

/* Add a red background color to the cancel button */
.edit-form-container .cancel {
    background-color: #b71c1c;
}

    </style>
</head>

<body>
    <header class="header">
        <div class="logo_navbar">
            <h2 class="logo_heading">Course Compass | Admin</h2>
        </div>
        <div class="header-right">
            <a class="logout-heading" href="{{ url('logout') }}">Logout</a>
        </div>
    </header>

    <div class="dashboard-container">
    @include('admin.sidebar') 

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
    <div id="editModal" class="edit-form-container">
    <span class="edit-header">Edit Course</span>
    <form action="{{ route('admin.updatecourse')}}" method="POST">
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
</script>