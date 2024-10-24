<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <script src="java.js" defer></script>
    <script src="java1.js" defer></script>
    <title>Beauty on Top</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>
<div id="container" class="container">
    <!-- FORM SECTION -->
    <div class="row">
        <!-- SIGN UP -->
        <div class="col align-items-center flex-col sign-up">
            <div class="form-wrapper align-items-center">
                <div class="form sign-up">
                    <form method="POST" action="registration.php">
                        <div class="input-group">
                            <label for="email">Email</label>
                            <div class="input-box">
                                <i class="fas fa-envelope"></i>
                                <input type="email" id="email" name="email" placeholder="Enter your email" required>
                            </div>
                        </div>
                        <div class="input-group">
                            <label for="username">Username</label>
                            <div class="input-box">
                                <i class="fas fa-user"></i>
                                <input type="text" id="username" name="username" placeholder="Enter your username" required>
                            </div>
                        </div>
                        <div class="input-group">
                            <label for="password">Password</label>
                            <div class="input-box">
                                <i class="fas fa-lock"></i>
                                <input type="password" id="password" name="password" placeholder="Password" required>
                                <span class="eye-icon" onclick="togglePasswordVisibility('password')">
                                    <i class="fas fa-eye"></i>
                                </span>
                            </div>
                        </div>
                        <div class="input-group">
                            <label for="confirm-password">Confirm Password</label>
                            <div class="input-box">
                                <i class="fas fa-lock"></i>
                                <input type="password" id="confirm-password" name="confirmPassword" placeholder="Confirm password" required>
                                <span class="eye-icon" onclick="togglePasswordVisibility('confirm-password')">
                                    <i class="fas fa-eye"></i>
                                </span>
                            </div>
                        </div>
                        <button type="submit" name="register">
                            Sign up
                        </button>
                    </form>
                    <p>
                        <span>Already have an account?</span>
                        <b onclick="toggle()" class="pointer">Sign in here</b>
                    </p>
                </div>
            </div>
        </div>
        <!-- END SIGN UP -->

        <!-- SIGN IN -->
        <div class="col align-items-center flex-col sign-in">
            <div class="form-wrapper align-items-center">
                <div class="form sign-in">
                    <form method="POST" action="login.php">
                        <div class="input-group">
                            <label for="signin-username">Username</label>
                            <div class="input-box">
                                <i class="fas fa-user"></i>
                                <input type="text" id="signin-username" name="loginUsername" placeholder="Enter your username" required>
                            </div>
                        </div>
                        <div class="input-group">
                            <label for="signin-password">Password</label>
                            <div class="input-box">
                                <i class="fas fa-lock"></i>
                                <input type="password" id="signin-password" name="loginPassword" placeholder="Password" required>
                                <span class="eye-icon" onclick="togglePasswordVisibility('signin-password')">
                                    <i class="fas fa-eye"></i>
                                </span>
                            </div>
                        </div>
                        <button type="submit" name="login">
                            Sign in
                        </button>
                    </form>
                    <p>
                        <b onclick="window.location.href='forgot.php'" class="pointer">Forgot Password?</b>
                    </p>
                    <p>
                        <span>Don't have an account?</span>
                        <b onclick="toggle()" class="pointer">Sign up here</b>
                    </p>
                </div>
            </div>
        </div>
        <div class="row content-row">
            <!-- SIGN IN CONTENT -->
            <div class="col align-items-center flex-col">
                <div class="text sign-in">
                    <h2>
                        Welcome
                    </h2>
                </div>
                <div class="img sign-in">
                </div>
            </div>
            <!-- END SIGN IN CONTENT -->
            <!-- SIGN UP CONTENT -->
            <div class="col align-items-center flex-col">
                <div class="img sign-up">
                </div>
                <div class="text sign-up">
                    <h2>
                        Join with us
                    </h2>
                </div>
            </div>
            <!-- END SIGN UP CONTENT -->
        </div>
        <!-- END CONTENT SECTION -->
    </div>
</div>
<script>
    function togglePasswordVisibility(inputId) {
        const input = document.getElementById(inputId);
        const icon = input.nextElementSibling.querySelector('i'); 
        if (input.type === "password") {
            input.type = "text";
            icon.classList.remove("fa-eye");
            icon.classList.add("fa-eye-slash");
        } else {
            input.type = "password";
            icon.classList.remove("fa-eye-slash");
            icon.classList.add("fa-eye");
        }
    }
</script>
</body>
</html>
