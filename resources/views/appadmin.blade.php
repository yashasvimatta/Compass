<!-- resources/views/layouts/app.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Course Compass')</title>
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
    @yield('content')
</body>
<footer class="footer">
        &copy; 2023 WDM Group 7 | <a class="footer_anchor" href="contactUs.php">Contact Us</a> | <a
            class="footer_anchor" href="aboutUs.php">About Us</a> | <a class="footer_anchor"
            href="services.php">Services</a>
    </footer>
</html>




<!-- Dilip Mahadik, Abhinav - 1002077234
    Misba, Asfiya - 1002028239
    Rajesh Neelam, Haswanth  - 1002063344
    Ponugupati, Maruthi Murali Krishna - 1002069076
    Vyas, Shalini - 1002087896 */

    /* font-family: Arial, sans-serif */

    /* background-color: #2C3E50;
    color: #fff;  -->

    <?php
// session_start();

include('includes/dbcon.php');

if (isset($_COOKIE['user_role'])) {
    $role = $_COOKIE['user_role'];
    echo "User Role: " . $role;
    if ($role == 'admin') {

    } else if ($role == 'instructor') {
        ?>
            <script>
                location.replace("instructor_dashboard.php");
            </script>
        <?php
    } else if ($role == 'Quality_Assurance') {
        ?>
                <script>
                    location.replace("quality_qao1.php");
                </script>
        <?php
    } else if ($role == 'Program_Coordinator') {
        ?>
                    <script>
                        location.replace("program_coordinator.php");
                    </script>
        <?php
    } else if ($role == 'student') {
        ?>
                        <script>
                            location.replace("dashboard-student.php");
                        </script>
        <?php
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="stylesheet" type="text/css" href="css/admin.css" />
   
</head>

<body>
    <header class="header">
        <div class="logo_navbar">
            <h2 class="logo_heading">Course Compass | Admin</h2>
        </div>
        <div class="header-right">
            <a class="logout-heading" href="logout.php">Logout</a>
        </div>
    </header>

    <div class="dashboard-container">
        <nav class="side-nav">
            <ul>
                <li><a class="active" href="admin.php">Dashboard</a></li>
                <li><a href="manage_users.php">Manage Users</a></li>
                <!-- <li><a href="userPermission_admin.html">User Permissions</a></li> -->
                <li><a href="students_admin.php">Students</a></li>
                <li><a href="instructor_admin.php">Instructors</a></li>
                <li><a href="qao_admin.php">QAO</a></li>
                <li><a href="program_coordinator_admin.php">Program Coordinator</a></li>
                <li><a href="courses_admin.php">Courses</a></li>
                <li><a href="manage_courses_admin.php">Manage Courses</a></li>
                <!-- <li><a href="settings_admin.php">Website Settings</a></li> -->
                <li><a href="issue_resolution_admin.php">Issue Resolution</a></li>
            </ul>
        </nav>

        <section class="dashboard second-section">
            <div class="dashboard-header">
                <h2>Dashboard</h2>
            </div>
            <?php
            $iquery = "SELECT * FROM user";

            // Create a prepared statement
            $stmt = mysqli_prepare($con, $iquery);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            $totalRows = mysqli_num_rows($result);
            ?>
            <div class="performance-metrics">
                <div class="metric">
                    <h3>Total Users</h3>
                    <p>
                        <?php echo $totalRows ?>
                    </p>
                </div>
                <?php
                ?>

                <div class="metric">
                    <?php
                    $iquery = "SELECT * FROM course where status='1'";

                    // Create a prepared statement
                    $stmt = mysqli_prepare($con, $iquery);
                    mysqli_stmt_execute($stmt);
                    $result = mysqli_stmt_get_result($stmt);
                    $totalRows = mysqli_num_rows($result);
                    ?>
                    <h3>Total Courses</h3>
                    <p>
                        <?php echo $totalRows ?>
                    </p>
                </div>
            </div>

            <?php
            $iquery = "SELECT * FROM user where role='student'";

            // Create a prepared statement
            $stmt = mysqli_prepare($con, $iquery);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            $totalRows = mysqli_num_rows($result);
            ?>
            <div class="performance-metrics">
                <div class="metric">
                    <h3>Total Student</h3>
                    <p>
                        <?php echo $totalRows ?>
                    </p>
                </div>
                <?php
                ?>

                <div class="metric">
                    <?php
                    $iquery = "SELECT * FROM user where role='instructor'";

                    // Create a prepared statement
                    $stmt = mysqli_prepare($con, $iquery);
                    mysqli_stmt_execute($stmt);
                    $result = mysqli_stmt_get_result($stmt);
                    $totalRows = mysqli_num_rows($result);
                    ?>
                    <h3>Total Instructor</h3>
                    <p>
                        <?php echo $totalRows ?>
                    </p>
                </div>
            </div>

            <div class="performance-metrics">
                <?php
                ?>

                <div class="metric">
                    <?php
                    $iquery = "SELECT * FROM user where role='Quality_Assurance'";

                    // Create a prepared statement
                    $stmt = mysqli_prepare($con, $iquery);
                    mysqli_stmt_execute($stmt);
                    $result = mysqli_stmt_get_result($stmt);
                    $totalRows = mysqli_num_rows($result);
                    ?>
                    <h3>Total QAO</h3>
                    <p>
                        <?php echo $totalRows ?>
                    </p>
                </div>

                <div class="metric">
                    <?php
                    $iquery = "SELECT * FROM user where role='Program_Coordinator'";

                    // Create a prepared statement
                    $stmt = mysqli_prepare($con, $iquery);
                    mysqli_stmt_execute($stmt);
                    $result = mysqli_stmt_get_result($stmt);
                    $totalRows = mysqli_num_rows($result);
                    ?>
                    <h3>Total Program Coordinator</h3>
                    <p>
                        <?php echo $totalRows ?>
                    </p>
                </div>
            </div>



        </section>
    </div>
    <?php
    if (isset($_POST['submit'])) {
        if (isset($_COOKIE['user_id'])) {
            $user_id = $_COOKIE['user_id'];

            $msg = mysqli_real_escape_string($con, $_POST['msg']);

            $insertquery = "INSERT INTO chat (msg,user_id ) VALUES ('$msg','$user_id' )";
            $iquery = mysqli_query($con, $insertquery);

            if ($iquery) {
                echo "<script>alert('Message Sent');</script>";
            } else {
                echo "<script>alert('Failed to Send');</script>";
            }
        } else {
            echo "<script>alert('User ID not found in the cookie');</script>";
        }
    }

    ?>
    <button class="open-button" onclick="openForm()">Chat</button>

    <div class="chat-popup" id="myForm" method='POST'>
        <form action="/action_page.php" class="form-container">
            <h1>Chat</h1>
            <?php if (isset($_COOKIE['user_id'])) {
                $user_id = $_COOKIE['user_id'];

                $iquery = "SELECT * FROM chat WHERE user_id = ?";

                // Create a prepared statement
                $stmt = mysqli_prepare($con, $iquery);

                if ($stmt) {
                    // Bind the user_id as an integer parameter
                    mysqli_stmt_bind_param($stmt, "i", $user_id);

                    // Execute the statement
                    mysqli_stmt_execute($stmt);

                    // Get the result
                    $result = mysqli_stmt_get_result($stmt);

                    if ($row = mysqli_fetch_assoc($result)) {
                        // User found, get and display the first name
            
                    } else {
                        echo "User not found.";
                    }

                    // Close the prepared statement
                    mysqli_stmt_close($stmt);
                } else {
                    echo "Error: Could not prepare the SQL statement.";
                }
            }
            ?>

            <label for="msg"><b>>
                    <?php
                    if (isset($row['msg'])) {
                        echo $row['msg'];
                    } else {
                        echo "type your message";
                    }
                    ?>
                </b></label>
            <textarea placeholder="Type message.." name="msg" required></textarea>

            <button type="submit" class="btn" name="submit">Send</button>
            <button type="button" class="btn cancel" onclick="closeForm()">Close</button>
        </form>
    </div>

    </div>

    <footer class="footer">
        &copy; 2023 WDM Group 7 | <a class="footer_anchor" href="contactUs.php">Contact Us</a> | <a
            class="footer_anchor" href="aboutUs.php">About Us</a> | <a class="footer_anchor"
            href="services.php">Services</a>
    </footer>

    <script>
        function openForm() {
            document.getElementById("myForm").style.display = "block";
        }

        function closeForm() {
            document.getElementById("myForm").style.display = "none";
        }
        function openApprove() {
            document.getElementById("openApprove").style.display = "block";
        }

        function closeOpenApprove() {
            document.getElementById("openApprove").style.display = "none";
        }
        function openReject() {
            document.getElementById("openReject").style.display = "block";
        }

        function closeOpenReject() {
            document.getElementById("openReject").style.display = "none";
        }
    </script>
</body>

</html>