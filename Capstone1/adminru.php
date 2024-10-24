<?php
session_start(); 

require('./database.php');
require('./read.php'); 

$queryUsers = "SELECT * FROM register"; // Query to get all users from the register table
$sqlUsers = mysqli_query($connection, $queryUsers);

$result = null; 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="style3.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <title>Registered Users</title>
    <style>
        h3 {
            margin-top: 20px;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="adminru.php">Home</a>
        </div>
        <ul class="nav navbar-nav">
            <li><a href="SMS.php">SMS API</a></li>
            <li><a href="email.php">Email Notification</a></li>
            <li><a href="logout1.php" onclick="return confirmLogout()">Log Out</a></li>
        </ul>
    </div>
</nav>

<div class="container">
    <div class="row">
        <div class="col-md-6">
            <h3>Registered Users</h3>
        </div>
        <div class="col-md-6 text-right">
            <h3><a href="admindb.php">Booked Appointments</a></h3>
        </div>
    </div>
    
    <div class="table-responsive"> <!-- Added responsive table wrapper -->
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Email</th>
                    <th>Username</th>
                    <th>Password</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($results = mysqli_fetch_array($sqlUsers)) { ?>
                    <tr>
                        <td><?php echo $results['ID'] ?></td>
                        <td><?php echo $results['Email'] ?></td>
                        <td><?php echo $results['Username'] ?></td>
                        <td><?php echo $results['Password'] ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<script>
function confirmLogout() {
    return confirm("Are you sure you want to log out?");
}
</script>

</body>
</html>
