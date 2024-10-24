<?php
include 'database.php'; // Include your database connection file

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $token = $_POST['token'];
    $newPassword = $_POST['new_password'];

    // Verify the token and check if it is still valid
    $query = "SELECT * FROM register WHERE reset_token='$token' AND token_expiry > NOW()";
    $result = mysqli_query($connection, $query);

    if (mysqli_num_rows($result) > 0) {
        // Token is valid, update the password
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT); // Hash the new password
        $updateQuery = "UPDATE register SET Password='$hashedPassword', reset_token=NULL, token_expiry=NULL WHERE reset_token='$token'";
        mysqli_query($connection, $updateQuery);
        echo "Your password has been reset successfully.";
    } else {
        echo "Invalid or expired token.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
</head>
<body>
    <h2>Reset Password</h2>
    <?php if (isset($_GET['token'])): ?>
    <form method="POST" action="">
        <input type="hidden" name="token" value="<?php echo htmlspecialchars($_GET['token']); ?>">
        <label for="new_password">Enter new password:</label>
        <input type="password" id="new_password" name="new_password" required>
        <button type="submit">Reset Password</button>
    </form>
    <?php else: ?>
        <p>No token provided. Please request a password reset link first.</p>
    <?php endif; ?>
</body>
</html>
