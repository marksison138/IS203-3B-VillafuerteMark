<?php
require('./database.php');

if (isset($_POST['delete'])) {
    $id = $_POST['id'];

    // Query to delete the record
    $queryDelete = "DELETE FROM book WHERE ID = $id";
    $sqlDelete = mysqli_query($connection, $queryDelete);

    if ($sqlDelete) {
        echo '<script>alert("Record Deleted Successfully!")</script>';
    } else {
        echo '<script>alert("Failed to Delete Record!")</script>';
    }

    echo '<script>window.location.href = "/Capstone1/admindb.php"</script>';
}
?>
