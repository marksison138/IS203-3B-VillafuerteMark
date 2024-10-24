<?php
session_start();
require('./database.php');

// Check if contact number is provided
if (isset($_POST['contact'])) {
    $contact = $_POST['contact'];

    // Prepare the SQL statement to prevent SQL injection
    $stmt = $connection->prepare("SELECT COUNT(*) FROM book WHERE Number = ?");
    $stmt->bind_param("s", $contact);
    $stmt->execute();
    $stmt->bind_result($count);
    $stmt->fetch();
    
    // Return a JSON response
    echo json_encode(array('exists' => $count > 0));

    // Close the statement
    $stmt->close();
}
?>
