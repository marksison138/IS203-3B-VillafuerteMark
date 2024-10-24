<?php
require __DIR__ . '/twilio-php-main/src/Twilio/autoload.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $phone = $_POST['phone'];
    $message = $_POST['message'];

    $sid = "AC509809b676021ded42074b61757e0512";
    $token = "610ed7af492b56baf496b9c45ecbe04f";
    $client = new Twilio\Rest\Client($sid, $token);

    try {
        $client->messages->create(
            $phone,
            [
                'from' => '+12084864297', 
                'body' => $message
            ]
        );
        
        echo '<script>alert("Message sent successfully!")</script>';
    } catch (Exception $e) {
        echo '<script>alert("Failed to Sent!")</script>';
    }
    echo '<script>window.location.href = "/Capstone1/SMS.php"</script>';
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Twilio SMS Sender</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="style3.css"> 
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="admindb.php">Home</a>
            </div>
            <ul class="nav navbar-nav">
                <li><a href="email.php">Email Notification</a></li>
                <li><a href="logout.php" onclick="return confirmLogout()">Log Out</a></li>
            </ul>
        </div>
    </nav>

    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <h2 class="text-center">Send SMS via Twilio</h2>
                <?php if (isset($status)): ?>
                    <div class="alert alert-info">
                        <?= $status ?>
                    </div>
                <?php endif; ?>
                <form method="POST" action="">
                    <div class="form-group">
                        <label for="phone">Phone Number</label>
                        <input type="text" class="form-control" id="phone" name="phone" placeholder="+1234567890" required>
                    </div>
                    <div class="form-group">
                        <label for="message">Message</label>
                        <textarea class="form-control" id="message" name="message" rows="4" placeholder="Type your message here..." required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Send SMS</button>
                </form>
            </div>
        </div>
    </div>


</body>
</html>