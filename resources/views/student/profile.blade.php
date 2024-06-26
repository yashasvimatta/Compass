<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Profile</title>
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
    <h2><i class="fas fa-users"></i> Student Profile</h2>

   <section class="container-fluid">
    <button class="toggle-button" onclick="toggleSidebar()">&#9776;</button>

    <!-- Student Profile -->
    <div class="student-profile py-4">
    <div class="container">
        <div class="row">
            <div class="col-lg-4">
                <div class="card shadow-sm">
                    <div class="card-header bg-transparent text-center">
                        <img class="profile_img" src="{{ asset('images/userimg.png') }}" alt="Profile Image">
                        <h3>{{ $profile['first_name'] }}</h3>
                    </div>
                    <div class="card-body">
                        <p class="mb-0"><strong class="pr-1">Student ID:</strong>{{ $profile['user_id'] }}</p>
                        <p class="mb-0"><strong class="pr-1">Email:</strong>{{ $profile['email'] }}</p>
                        <p class="mb-0"><strong class="pr-1">Phone:</strong>{{ $profile['phone'] }}</p>
                        <button class="open-button1" onclick="openForm1()">Edit</button>
                    </div>
                </div>
            </div>
            <div class="col-lg-8 student-edit">
                <div class="card shadow-sm">
                    <div class="card-header bg-transparent border-0">
                        <h3 class="mb-0">General Information</h3>
                    </div>
                    <div class="card-body pt-0">
                        <table class="table table-bordered">
                            <tr>
                                <th width="30%">Gender</th>
                                <td width="2%">:</td>
                                <td>{{ $profile['gender'] }}</td>
                            </tr>
                            <tr>
                                <th width="30%">Address</th>
                                <td width="2%">:</td>
                                <td>{{ $profile['address'] }}</td>
                            </tr>
                            <tr>
                                <th width="30%">Birth Date</th>
                                <td width="2%">:</td>
                                <td>{{ $profile['dob'] }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
  </section>
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
