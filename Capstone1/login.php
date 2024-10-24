<?php
require('./database.php');


// Login Process
if (isset($_POST['login'])) {
    $username = $_POST['loginUsername'];
    $password = $_POST['loginPassword'];

    $queryLogin = "SELECT * FROM register WHERE Username = '$username'";
    $resultLogin = mysqli_query($connection, $queryLogin);
    $user = mysqli_fetch_assoc($resultLogin);

    if ($user && $password === $user['Password']) {
        // Password matches, login successful
        echo '<script>alert("Login Successful! Welcome ' . $user['Username'] . '"); window.location.href="/Capstone1/dashboard.php";</script>';
    } else {
        // Invalid credentials
        echo '<script>alert("Invalid Username or Password!"); window.location.href="index.php";</script>';
    }
}
?>