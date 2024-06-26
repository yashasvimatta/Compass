
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Students</title>
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
    <h2><i class="fas fa-users"></i> Manage Students</h2>

    <table id="customers" class="users-table">
    <thead>
                    <tr>
                        <th>User Id</th>
                        <th>User Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Action</th>
                    </tr>
                </thead>
        <tbody>
            @foreach ($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->first_name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->role }}</td>
                <td>
                    <button class="button button1"  onclick="openEditModal({{ $user->id }}, '{{ $user->first_name }}', '{{ $user->email }}', '{{ $user->phone }}')">
                        Edit
                    </button>
                    <!-- <button class="button button1">Edit</button> -->
                    <button class="button button2">
                        <a class="text-highlight" href="{{ route('admin.deleteuser', ['deleteid' => $user->id]) }}">Delete</a>
                    </button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <!-- Add this HTML structure for the modal at the end of your Blade file -->
<div class="modal" id="editModal" tabindex="-1" role="dialog" style="display: none;">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <!-- Add your modal content here -->
            <div class="modal-header">
                <h5 class="modal-title">Edit User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Add your form fields for editing here -->
                <!-- For example: -->
                <form id="editForm">
                    @csrf
                    <input type="hidden" id="userId" name="userId" value="">
                    <label for="firstName">First Name:</label>
                    <input type="text" id="firstName" name="firstName" value="">
                    <label for="phone">Phone:</label>
                    <input type="text" id="phone" name="phone" value="">
                    <label for="email">Email:</label>
                    <input type="text" id="email" name="email" value="">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="updateUser()">Save changes</button>
            </div>
        </div>
    </div>
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
<script>
    function openEditModal(userId, firstName, email, phone) {
        // Populate the modal fields with user data
        document.getElementById('firstName').value = firstName;
        document.getElementById('email').value = email;
        document.getElementById('phone').value = phone;
        $('#userId').val(userId);
        $('#editModal').modal('show');
    }

    function updateUser() {
        var formData = $('#editForm').serialize();

    // Send an AJAX request to update the user
    $.ajax({
        type: 'POST',
        url: '/admin/update-user', // Replace with your actual update endpoint
        data: formData,
        contentType: 'application/x-www-form-urlencoded', 
        success: function(response) {
            // Handle success, e.g., close the modal
            alert('User updated successfully.');
            $('#editModal').modal('hide');
            location.reload(true);
            // You can also update the table or perform other actions as needed
        },
        error: function(error) {
            // Handle errors
            alert('Error updating user:', error);
        }
    });
    }
     // Add this script to hide the modal on page load
     $(document).ready(function () {
        $('#editModal').modal('hide');
    });
    
</script>
</html>