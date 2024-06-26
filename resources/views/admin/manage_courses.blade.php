
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Program Coordinators</title>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" >
    <link rel="stylesheet" type="text/css"  href="{{ asset('css/admin.css') }}" />
    <style>
         /* Override Bootstrap modal styles */
    #editModal .modal-dialog {
        max-width: 800px; /* Set your desired maximum width */
    }

    #editModal .modal-content {
        border: none; /* Remove the default border */
        border-radius: 10px; /* Add border-radius for rounded corners */
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.1); /* Add a subtle box shadow */
    }

    #editModal .modal-header {
        background-color: #007bff; /* Set the header background color */
        color: #fff; /* Set the header text color */
        border-bottom: none; /* Remove the bottom border */
        border-radius: 10px 10px 0 0; /* Add border-radius only to the top */
    }

    #editModal .modal-title {
        font-weight: bold; /* Make the title bold */
    }

    #editModal .modal-body {
        padding: 20px; /* Add padding to the modal body */
    }

    #editModal .modal-footer {
        border-top: none; /* Remove the top border from the footer */
        border-radius: 0 0 10px 10px; /* Add border-radius only to the bottom */
    }
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
        .error-message {
            color: red;
        }
        textarea {
            width: 100%;
            padding: 15px;
            margin: 5px 0 22px 0;
            border: none
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
    </style>
</head>

<body>
    <header class="header">
        <div class="logo_navbar">
            <h2 class="logo_heading">Course Compass | Manage Course</h2>
        </div>
        <div class="header-right">
            <a class="logout-heading" href="{{ url('logout') }}">Logout</a>
        </div>
    </header>

    <div class="dashboard-container">
    @include('admin.sidebar') 

        <div class="performance_data second-section">
            <h2>Course Management</h2>
            <form method="POST" action="/admin/savecourse">
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
        <div class="form-group">
        <label for="user_id">Instructor:</label>
                <select name="user_id" id="user_id" class="form-control">
                    @foreach($users as $user)
                        <option value="{{ $user->id }}">{{ $user->first_name }}</option>
                    @endforeach
                </select>
    </div>

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
    </div>

    <footer class="footer">
        &copy; 2023 WDM Group 7 | <a class="footer_anchor" href="contactUs">Contact Us</a> | <a
            class="footer_anchor" href="aboutUs">About Us</a> | <a class="footer_anchor"
            href="services">Services</a>
    </footer>
</body>
</html>