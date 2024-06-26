<!-- Dilip Mahadik, Abhinav - 1002077234
    Misba, Asfiya - 1002028239
    Rajesh Neelam, Haswanth  - 1002063344
    Ponugupati, Maruthi Murali Krishna - 1002069076
    Vyas, Shalini - 1002087896 */

    /* font-family: Arial, sans-serif */

    /* background-color: #2C3E50;
    color: #fff;  -->
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forget Password</title>
    <style>
        :root {
            --primary-color: #2c3e50;
            --text-color: #333;
            --body-font: Arial, sans-serif;
            --heading-font: Arial, sans-serif;
        }
        body {
            font-family: var(--body-font);
            background-color: #fff;
            margin: 0;
            padding: 0;
        }
        header {
            overflow: hidden;
            background-color: var(--primary-color);
            padding: 30px 10px;
            transition: 0.4s;
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 99;
        }

        footer {
            background-color: var(--primary-color);
            color: #ffffff;
            text-align: center;
            padding: 15px;
            position: fixed;
            height : 60px;
            left: 0;
            bottom: 0;
            width: 100%;
            box-shadow: 0px -2px 6px rgba(0, 0, 0, 0.1);
        }

        .container {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            background-color: #CECECE;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
            text-align: center;
            position: relative;
            top: 200px;
            margin-top: 5%;
        }

        header h1 {
            display: inline;
            margin-right: 20px;
            color: #fff;
            cursor: pointer;
        }
        header h4 {
            display: inline;
            padding-right: 1%;
            float: right;
            margin-right: 20px;
            color: #fff;
            cursor: pointer;
        }

        h2 {
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            margin-left: 3%;
            display: block;
            font-weight: bold;
            text-align: left;
        }

        .form-group input {
            width: 90%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .form-group button {
            margin-top: 20px;
            background-color: #000000;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
        }

        .form-group button:hover {
            background-color: #0056b3;
        }

        a{
           color: #ffffff;
        }

        @media (max-width: 768px) {
            header h1, header h4 {
                display: block;
                text-align: left;
                margin: 12px;
                
            }
            .container {
                width: 60%;
                top: 210px;
            }
            h4{
                padding: 5px;
                
            }}
    </style>
</head>
<body>
    <header>
        <h1>Course Compass | Forget Password</h1>
        <h4><a href="login">Login</a></h4>
        <h4><a href="/">Home</a></h4>

    </header>
    
    <div class="container">
        <h2>Reset your Password</h2>
        <form id="loginForm">
            <div class="form-group">
                <label for="Email">Email:</label>
                <input type="email" id="Email" name="Email" required>
            </div>
            <p>We will send you an email that will allow you to reset your password</p>
            <div class="form-group">
                <button type="button" onclick="forgotPassword()">Forget Password</button>
            </div>
        </form>
    </div>

    <footer>
        &copy; 2023 WDM Group 7 | <a href="contactUs.php">Contact Us</a> | <a href="aboutUs.php">About Us</a> | <a href="services.php">Services</a>
    </footer>
</body>
</html>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
    function forgotPassword() {
        var email = $('#Email').val();
        var csrfToken = '{{ csrf_token() }}';
        $.ajax({
            url: '/forgotpassword', // Replace with your actual endpoint
            method: 'POST',
            data: { email: email, _token: csrfToken },
            success: function(response) {
                alert(response.message); // Display success or failure message
            },
            error: function(xhr, status, error) {
                alert('Failed to send password reset email'); // Display a generic error message
            }
        });
    }
</script>
