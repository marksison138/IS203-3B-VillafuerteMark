<?php
session_start(); 

require('./database.php');
require('./read.php'); 

$queryBookings = "SELECT * FROM book"; // Query to get all bookings
$sqlBookings = mysqli_query($connection, $queryBookings);

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
    <title>Booked Appointments</title>
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
            <a class="navbar-brand" href="admindb.php">Home</a>
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
            <h3>Booked Appointments</h3>
        </div>
        <div class="col-md-6 text-right">
            <h3><a href="adminru.php">Registered Users</a></h3>
        </div>
    </div>
    
    <div class="table-responsive"> <!-- Added responsive table wrapper -->
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Service</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Full Name</th>
                    <th>Contact Number</th>
                    <th>Special Requests</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($results = mysqli_fetch_array($sqlBookings)) { ?>
                    <tr>
                        <td><?php echo $results['ID'] ?></td>
                        <td><?php echo $results['Service'] ?></td>
                        <td><?php echo $results['Date'] ?></td>
                        <td><?php echo $results['Time'] ?></td>
                        <td><?php echo $results['FullName'] ?></td>
                        <td><?php echo $results['Number'] ?></td>
                        <td><?php echo $results['Request'] ?></td>
                        <td>
                            <form action="delete.php" method="post" style="display:inline;" onsubmit="return confirmDelete()">
                                <input type="hidden" name="id" value="<?php echo $results['ID'] ?>">
                                <input type="submit" name="delete" value="DELETE" class="btn btn-danger btn-sm">
                            </form>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<script>
function confirmDelete() {
    return confirm("Are you sure you want to delete this record?");
}

function confirmLogout() {
    return confirm("Are you sure you want to log out?");
}
</script>

</body>
</html>
