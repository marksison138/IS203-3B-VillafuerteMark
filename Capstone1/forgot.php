<?php
include 'database.php'; // Include your database connection file

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];

    // Check if the email exists in the database
    $query = "SELECT * FROM register WHERE Email = '$email'";
    $result = mysqli_query($connection, $query);

    if (mysqli_num_rows($result) > 0) {
        // Email exists, generate a unique token
        $token = bin2hex(random_bytes(50)); // Generate a secure random token
        $expiry = date("Y-m-d H:i:s", strtotime('+1 hour')); // Token expires in 1 hour

        // Store the token and its expiry in the database
        $updateQuery = "UPDATE register SET reset_token='$token', token_expiry='$expiry' WHERE Email='$email'";
        mysqli_query($connection, $updateQuery);

        // Send the reset link via email (using PHP's mail function)
        $resetLink = "http://yourdomain.com/reset.php?token=$token"; // Replace with your actual domain
        $subject = "Password Reset Request";
        $message = "Click the link to reset your password: $resetLink";

        // Uncomment the following line to send the email (make sure your server is configured to send emails)
        // mail($email, $subject, $message);

        echo "A reset link has been sent to your email address.";
    } else {
        echo "Email not found. Please check your email address.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
</head>
<body>
    <h2>Forgot Password</h2>
    <form method="POST" action="">
        <label for="email">Enter your email:</label>
        <input type="email" id="email" name="email" required>
        <button type="submit">Send Reset Link</button>
    </form>
</body>
</html>
