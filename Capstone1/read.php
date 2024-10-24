<?php

require('./database.php');

$querryAccounts = "SELECT * FROM book";
$sqlAccounts = mysqli_query($connection, $querryAccounts);

?>