<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course Compass</title>
    <link rel="stylesheet" href="css/signup_candidate.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
        integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        .error-message {
            color: red;
        }
    </style>
</head>

<body>
    <header>
        <header class="header">
            <div class="logo_navbar">
                <h2 class="logo_heading">Course Compass | Register</h2>
            </div>
            <div class="header-right">
                <a class="logout-heading" href="homepage">Home</a>
                <a class="logout-heading" href="contactUs">Contact</a>
                <a class="logout-heading" href="aboutUs">About</a>
                <a class="logout-heading" href="services">Services</a>
                <a class="logout-heading" href="login">Login</a>
            </div>
        </header>

        <main>
            <section id="signup">
                <div class="signup-container">
                    <h2 class="signup-header">Sign Up for Course Compass</h2>

                    <form  method="POST" action="{{ url('/register') }}" enctype="multipart/form-data" >
                    @csrf
                        <!-- Profile Info -->
                        <div class="section">
                            <div class="role-dropdown">
                                <label for="role" name="role" required>Select Role:</label>
                                <select name="selectedRole">
                                    <option value="student">Student</option>
                                    <option value="instructor">Instructor</option>
                                    <option value="Quality_Assurance">Quality Assurance Officer</option>
                                    <option value="Program_Coordinator">Program Coordinator</option>
                                </select>
                                @error('selectedRole')
            <div class="error-message">{{ $message }}</div>
        @enderror
                            </div>
                            <h3>Profile Info</h3>
                            <div class="input-container">
                                <label for="firstName">First Name:</label>
                                <input type="text" id="firstName" name="firstName">
                                @error('firstName')
            <div class="error-message">{{ $message }}</div>
        @enderror
                            </div>
                            <div class="input-container">
                                <label for="lastName">Last Name:</label>
                                <input type="text" id="lastName" name="lastName" >
                                @error('lastName')
            <div class="error-message">{{ $message }}</div>
        @enderror
                            </div>
                            <div class="input-container">
                                <label for="phone">Phone Number:</label>
                                <input type="tel" id="phone" name="phone" >
                                @error('phone')
            <div class="error-message">{{ $message }}</div>
        @enderror
                            </div>
                            <div class="input-container">
                                <label for="address">Address:</label>
                                <input type="text" id="address" name="address" >
                                @error('address')
            <div class="error-message">{{ $message }}</div>
        @enderror
                            </div>
                            <div class="input-container">
                                <label for="dob">Date of Birth:</label>
                                <input type="date" id="dob" name="dob" >
                                @error('dob')
            <div class="error-message">{{ $message }}</div>
        @enderror
                            </div>
                            <div class="input-container">
                                <label for="email">Email:</label>
                                <input type="email" id="email" name="email">
                                @error('email')
            <div class="error-message">{{ $message }}</div>
        @enderror
                            </div>
                            <div class="input-container">
                                <label for="password">Password:</label>
                                <input type="password" id="password" name="password">
                                @error('password')
            <div class="error-message">{{ $message }}</div>
        @enderror
                            </div>
                            <div class="input-container">
                                <label for="profilePicture">Profile Picture:</label>
                                <input type="file" id="profilePicture" name="profilePicture" accept="image/*">
                            </div>
                        </div>

                        <!-- Demographic Info -->
                        <div class="section">
                            <h3>Demographic Info</h3>
                            <div class="input-container">
                                <label for="race">Race:</label>
                                <input type="text" id="race" name="race" >
                                @error('race')
            <div class="error-message">{{ $message }}</div>
        @enderror
                            </div>
                            <div class="input-container">
                                <label for="ethnicity">Ethnicity:</label>
                                <input type="text" id="ethnicity" name="ethnicity" >
                                @error('ethnicity')
            <div class="error-message">{{ $message }}</div>
        @enderror
                            </div>
                            <div class="input-container">
                                <label for="maritalStatus">Marital Status:</label>
                                <input type="text" id="maritalStatus" name="maritalStatus" >
                                @error('maritalStatus')
            <div class="error-message">{{ $message }}</div>
        @enderror
                            </div>
                            <div class="input-container">
                                <label for="gender">Gender:</label>
                                <input type="text" id="gender" name="gender" >
                                @error('gender')
            <div class="error-message">{{ $message }}</div>
        @enderror
                            </div>
                        </div>
                        <button type="submit" name="submit" class="submit-btn">Submit</button>
                    </form>
                    <p>Already have an account? <a href="login">Log In</a></p>
                </div>
            </section>
        </main>

     


        <footer class="footer">
            &copy; 2023 WDM Group 7 </a>
        </footer>
</body>

</html>