<?php
require('./database.php');

// Registration Process
if (isset($_POST['register'])) {
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];

    if ($password !== $confirmPassword) {
        echo '<script>alert("Passwords do not match!"); window.location.href="index.php";</script>';
        exit();
    } elseif (strlen($password) < 8) {
        echo '<script>alert("Password must be at least 8 characters long!"); window.location.href="index.php";</script>';
        exit();
    } elseif ($username === $password) {
        echo '<script>alert("Username cannot be the same as password!"); window.location.href="index.php";</script>';
        exit();
    } else {
        $queryCheckUsername = "SELECT * FROM register WHERE Username = '$username'";
        $sqlCheckUsername = mysqli_query($connection, $queryCheckUsername);

        if (mysqli_num_rows($sqlCheckUsername) > 0) {
            echo '<script>alert("Username already exists! Please choose a different username."); window.location.href="index.php";</script>';
            exit();
        }

        $queryCheckEmail = "SELECT * FROM register WHERE Email = '$email'";
        $sqlCheckEmail = mysqli_query($connection, $queryCheckEmail);

        if (mysqli_num_rows($sqlCheckEmail) > 0) {
            echo '<script>alert("Email already used! Please choose a different email."); window.location.href="index.php";</script>';
            exit();
        }

        $queryRegister = "INSERT INTO register (Email, Username, Password) VALUES ('$email', '$username', '$password')";
        $sqlRegister = mysqli_query($connection, $queryRegister);

        if ($sqlRegister) {
            echo '<script>alert("Registration Successful!"); window.location.href="/Capstone1/index.php";</script>';
            exit();
        } else {
            echo '<script>alert("Failed to Register! Error: ' . mysqli_error($connection) . '"); window.location.href="index.php";</script>';
            exit();
        }
    }
}

?>

