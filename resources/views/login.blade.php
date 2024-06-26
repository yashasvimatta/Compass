<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" type="text/css" href="./css/login.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" /> 
</head>
<body>
    <div id="navbar">
        <a href="#default" id="logo">Course Compass</a>
        <div id="navbar-right">
          <a href="/">Home</a>
          <a href="contactUs">Contact</a>
          <a href="aboutUs">About</a>
          <a href="services">Services</a>
          <a href="signup">Sign Up</a>
        </div>
      </div>
    
      <div class="login-container">
        <h2>Sign in to your account</h2>
        <form id="loginForm" method="POST" action="{{ url('/login') }}">
        @csrf
            <div class="form-group">
                <label for="email"><i class="fa-solid fa-envelope"></i>Email</label>
                <input type="text" name="email" id="email">
                @error('email')
            <div class="error-message" style="color:red">{{ $message }}</div>
        @enderror
            </div>
            <div class="form-group">
                <label for="password"><i class="fa-solid fa-lock"></i> Password</label>
                <input type="password" name="password" id="password">
                @error('password')
            <div class="error-message" style="color:red">{{ $message }}</div>
        @enderror
            </div>
             <!-- Display a summary error message for invalid email or password -->
             @if(session('error'))
                <div class="error-message" style="color:red">{{ session('error') }}</div>
            @endif
            <div class="form-group">
                <button type="submit" name="submit">Login</button>
            </div>
            <a id="forgetPassword" href="/">Forgot Password?</a>
            <p>Don't have an account? <a id="forgetPassword" href="signup">Create</a></p>
        </form>
    </div>
    <footer>
        &copy; 2023 WDM Group 7 </a>
    </footer>

</body>
</html>