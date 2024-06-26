
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QA Feedback</title>
    <link rel="stylesheet" type="text/css"  href="{{ asset('css/admin.css') }}" />
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
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
    </style>
</head>

<body>
    <header class="header">
        <div class="logo_navbar">
            <h2 class="logo_heading">Course Compass | QAO</h2>
        </div>
        <div class="header-right">
            <a class="logout-heading" href="{{ url('logout') }}">Logout</a>
        </div>
    </header>

    <div class="dashboard-container">
    @include('qa.sidebar') 

        <section class="performance_data second-section">
    <h2><i class="fas fa-users"></i> Policies and Processes</h2>
    <div  style="width:100%">
        <!-- Button to trigger modal for adding a new policy -->
        <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#addPolicyModal">
            Add Policy
        </button>

        <!-- Policies Grid -->
        <table id="customers" class="users-table">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($policies as $policy)
                    <tr>
                        <td>{{ $policy->title }}</td>
                        <td>{{ $policy->description }}</td>
                        <td>
                            <!-- Button to trigger modal for editing a policy -->
                            <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editPolicyModal{{ $policy->id }}">
                                Edit
                            </button>

                            <!-- Delete Button (You can use a form for a real application) -->
                            <a href="{{ route('qa.destroy', $policy->id) }}" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</a>
                        </td>
                    </tr>

                    <!-- Edit Policy Modal -->
                    <div class="modal fade" id="editPolicyModal{{ $policy->id }}" tabindex="-1" role="dialog" aria-labelledby="editPolicyModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editPolicyModalLabel">Edit Policy</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <!-- Form to edit the policy (Assuming you have an update method in your controller) -->
                                    <form action="{{ route('qa.update', $policy->id) }}" method="POST" style="border:none;border-radius:0px;box-shadow:none;">
                                        @csrf
                                        @method('PUT')
                                        <div class="form-group">
                                            <label for="editTitle">Title</label>
                                            <input type="text" class="form-control" id="editTitle" name="title" value="{{ $policy->title }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="editDescription">Description</label>
                                            <textarea class="form-control" id="editDescription" name="description" required>{{ $policy->description }}</textarea>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Save Changes</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </tbody>
        </table>

        <!-- Add Policy Modal -->
        <div class="modal fade" id="addPolicyModal" tabindex="-1" role="dialog" aria-labelledby="addPolicyModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addPolicyModalLabel">Add Policy</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- Form to add a new policy -->
                        <form action="{{ route('qa.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="addTitle">Title</label>
                                <input type="text" class="form-control" id="addTitle" name="title" required>
                                @error('title')
            <div class="error-message">{{ $message }}</div>
        @enderror
                            </div>
                            <div class="form-group">
                                <label for="addDescription">Description</label>
                                <textarea class="form-control" id="addDescription" style="background-color:white;" name="description" required></textarea>
                                @error('description')
            <div class="error-message">{{ $message }}</div>
        @enderror
                            </div>
                            <div class="form-group">
                            <label for="document">Policy Document:</label>
                            <input type="file" class="form-control-file" id="document" name="document" accept=".pdf,.doc,.docx">
                            @error('document')
            <div class="error-message">{{ $message }}</div>
        @enderror
                        </div>
                            <button type="submit" class="btn btn-primary">Add Policy</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
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
    // JavaScript to open modals
    function openAddModal() {
        $('#addPolicyModal').modal('show');
    }

    function openEditModal(id) {
        $(`#editPolicyModal${id}`).modal('show');
    }
</script>