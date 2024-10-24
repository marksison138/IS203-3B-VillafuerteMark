<?php
session_start(); 
require('./database.php');

$searchId = isset($_POST['searchId']) ? $_POST['searchId'] : '';
$queryAppointments = "SELECT * FROM book";
if ($searchId) {
    $queryAppointments .= " WHERE ID = ?";
    $stmt = $connection->prepare($queryAppointments);
    $stmt->bind_param("s", $searchId);
    $stmt->execute();
    $sqlAppointments = $stmt->get_result();
} else {
    $sqlAppointments = mysqli_query($connection, $queryAppointments);
}

$username = isset($_SESSION['username']) ? $_SESSION['username'] : '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Beauty on Top / List of Appointments</title>
  <link rel="stylesheet" href="style1.css">
  <link rel="stylesheet" href="style6.css">
  <style>
    #search-container {
      display: none; /* Initially hidden */
      margin-top: 10px;
      text-align: left; /* Aligns text to the left */
    }

    .search-input {
      padding: 10px;
      font-size: 16px;
      border: 1px solid #ccc;
      border-radius: 4px;
      margin-right: 5px;
      width: 200px;
      transition: border-color 0.3s;
    }

    .search-input:focus {
      border-color: #007bff;
      outline: none;
    }

    .search-button {
      padding: 10px 15px;
      font-size: 16px;
      background-color: #007bff;
      color: white;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      transition: background-color 0.3s;
    }

    .search-button:hover {
      background-color: #0056b3;
    }

    .search-container {
      display: flex;
      justify-content: flex-start; /* Aligns items on the left side */
      align-items: center;
      margin: 10px;
    }
  </style>
  <script>
    function toggleSearch() {
      const searchContainer = document.getElementById('search-container');
      searchContainer.style.display = 'flex'; // Show search container
      const initialSearchButton = document.getElementById('initial-search-button');
      initialSearchButton.style.display = 'none'; // Hide initial search button
    }
  </script>
</head>
<body>
  <div class="container">
    <aside class="sidebar">
      <div class="logo">
        <img src="b12.jpg" alt="Salon Logo">
      </div>
      <nav>
        <ul>
          <li><a href="dashboard.php">Home</a></li>
          <li><a href="dashboard.php">Services</a></li>
          <li><a href="ments.php">Appointments</a></li>
          <li><a href="view.php">List of Appointments</a></li>
        </ul>
      </nav>
    </aside>

    <div class="main-content">
      <header>
        <div class="user-info">
          <span><?php echo htmlspecialchars($username); ?></span>
        </div>
      </header>

      <div class="search-container">
        <button id="initial-search-button" class="search-button" onclick="toggleSearch()">Search</button>
      </div>

      <div id="search-container">
        <form method="POST" style="display: flex; align-items: center; justify-content: flex-start;">
          <input id="search" type="text" name="searchId" class="search-input" placeholder="Enter your ID" required>
          <button type="submit" class="search-button">Search</button>
        </form>
      </div>

      <section class="dashboard">
        <div class="table-container">
          <table class="table">
            <thead>
              <tr>
                <th>ID</th>
                <th>Service</th>
                <th>Date</th>
                <th>Time</th>
                <th>Full Name</th>
                <th>Contact Number</th>
                <th>Special Requests</th>
              </tr>
            </thead>
            <tbody>
              <?php while ($appointment = mysqli_fetch_array($sqlAppointments)) { ?>
                <tr>
                  <td><?php echo htmlspecialchars($appointment['ID']); ?></td>
                  <td><?php echo htmlspecialchars($appointment['Service']); ?></td>
                  <td><?php echo htmlspecialchars($appointment['Date']); ?></td>
                  <td><?php echo htmlspecialchars($appointment['Time']); ?></td>
                  <td><?php echo htmlspecialchars($appointment['FullName']); ?></td>
                  <td><?php echo htmlspecialchars($appointment['Number']); ?></td>
                  <td><?php echo htmlspecialchars($appointment['Request']); ?></td>
                </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
      </section>
    </div>
  </div>
</body>
</html>
