
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Issues List</title>
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
    <h2><i class="fas fa-users"></i> Manage Issues</h2>

    <table id="customers" class="users-table">
    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Subject</th>
                        <th>Message</th>
                        <th>Response</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
        <tbody>
            @foreach ($issues as $issue)
            <tr>
                <td>{{ $issue->user_name}}</td>
                <td>{{ $issue->email}}</td>
                <td>{{ $issue->subject}}</td>
                <td>{{ $issue->message}}</td>
                <td>{{ $issue->response}}</td>
                <td>{{ $issue->status}}</td>
                <td>
                <button class="button button1" onclick="openEditModal({{ $issue }})">Message</button>
                <button class="button button1" onclick="markResolved({{ $issue }})">Mark Resolved </button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div id="editModal" class="edit-form-container">
    <span class="edit-header">Edit Ticket</span>
    <form action="{{ route('admin.updateticket')}}" method="POST">
        @csrf
        @method('PUT')
        <input type="hidden" id="id" name="id"/>
        <label for="response">Response:</label>
        <textarea id="response" name="response"></textarea>
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
        document.getElementById('response').value = course.response;
        document.getElementById('id').value = course.id;
        document.getElementById('editModal').style.display = 'block';
    }
    function markResolved(issue) {
        console.log(issue)
        // Assuming you have an endpoint for marking a ticket as resolved, replace 'your_endpoint' with the actual URL
        const endpoint = `/admin/markresolved/${issue.id}`;

        // Use fetch to make a POST request to mark the ticket as resolved
        fetch(endpoint, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}', // Include CSRF token if using Laravel
            }
        })
        .then(response => {
            if (!response.ok) {
                throw new Error(`HTTP error! Status: ${response.status}`);
            }
            return response.json();
        })
        .then(data => {
            // Handle success, you may choose to refresh the page or update the UI accordingly
            console.log('Ticket marked as resolved:', data);
        })
        .catch(error => {
            // Handle error
            console.error('Error marking ticket as resolved:', error);
        });
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