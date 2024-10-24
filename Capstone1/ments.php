<?php
session_start();
require('./database.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $service = $_POST['service'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $fullname = $_POST['name'];
    $number = $_POST['contact'];
    $request = $_POST['notes'];

    $stmt = $connection->prepare("INSERT INTO book (Service, Date, Time, FullName, Number, Request) VALUES (?, ?, ?, ?, ?, ?)");

    if ($stmt === false) {
        echo '<script>alert("Error in preparing the statement."); window.location.href="ments.php";</script>';
    } else {
        $stmt->bind_param("ssssss", $service, $date, $time, $fullname, $number, $request);

        if ($stmt->execute()) {
            echo '<script>alert("Your appointment has been successfully booked!"); window.location.href="ments.php";</script>';
        } else {
            $error = $stmt->error;
            echo "<script>alert('Failed to book your appointment. Error: $error'); window.location.href='ments.php';</script>";
        }
        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Beauty on Top / Dashboard</title>
  <link rel="stylesheet" href="style1.css">
  <link rel="stylesheet" href="style5.css">
</head>
<body>
<header>
        <div class="user-info">
          <p>☰</p>
          <div class="dropdown-content">
            <a href="logout.php" onclick="return confirmLogout()">Logout</a>
            <a href="print.php">Print this page</a>
          </div>
        </div>
      </header>

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
      <section class="dashboard">
        <div class="appointments">
          <div class="form-class">
            <div class="form">
              <h2>Book Your Appointment</h2>
              <form id="booking-form" method="POST" onsubmit="return validateForm()">
                <div class="form-group">
                  <label for="service">Select Service:</label>
                  <select id="service" name="service" required>
                    <option value="" disabled selected>Select a service</option>
                    <option value="haircut">Haircut</option>
                    <option value="manicure">Manicure</option>
                    <option value="hairstyle">HairStyle</option>
                    <option value="makeup">Makeup</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="date">Select Date:</label>
                  <input type="date" id="date" name="date" required>
                </div>
                <div class="form-group">
                  <label for="time">Select Time:</label>
                  <select id="time" name="time" required>
                    <option value="" disabled selected>Select a time</option>
                    <option value="9:00 AM">9:00 AM</option>
                    <option value="9:00 AM">9:30 AM</option>
                    <option value="10:00 AM">10:00 AM</option>
                    <option value="10:00 AM">10:30 AM</option>
                    <option value="11:00 AM">11:00 AM</option>
                    <option value="1:00 PM">1:00 PM</option>
                    <option value="2:00 PM">2:00 PM</option>
                    <option value="3:00 PM">3:00 PM</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="name">Your Full Name:</label>
                  <input type="text" id="name" name="name" placeholder="Enter your Full Name" required>
                </div>
                <div class="form-group">
                  <label for="contact">Contact Number:</label>
                  <input type="tel" id="contact" name="contact" placeholder="Enter 11 digits" required>
                </div>
                <div class="form-group">
                  <label for="notes">Special Requests:</label>
                  <textarea id="notes" name="notes" rows="4" placeholder="Any specific requests..."></textarea>
                </div>
                <div class="form-group">
                  <label>
                    <input type="checkbox" required>
                    I agree to the Beauty on Top policies.
                  </label>
                </div>
                <button type="submit" class="submit-button">Book Appointment</button>
              </form>
            </div>
          </div>
          <script>
            document.getElementById('name').addEventListener('input', function (e) {
                this.value = this.value.replace(/[^a-zA-Z\s]/g, '');
            });
            document.getElementById('notes').addEventListener('input', function (e) {
                this.value = this.value.replace(/[^a-zA-Z\s]/g, '');
            });
            document.getElementById('contact').addEventListener('input', function (e) {
                this.value = this.value.replace(/[^0-9]/g, '');
                checkContactExists(this.value);
            });
            function checkContactExists(contact) {
                if (contact.length === 11) {
                    const xhr = new XMLHttpRequest();
                    xhr.open('POST', 'check_contact.php', true);
                    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                    xhr.onreadystatechange = function () {
                        if (xhr.readyState === 4 && xhr.status === 200) {
                            const response = JSON.parse(xhr.responseText);
                            if (response.exists) {
                                alert("This contact number is already registered. Please use a different number.");
                                document.getElementById('contact').value = '';
                            }
                        }
                    };
                    xhr.send('contact=' + encodeURIComponent(contact));
                }
            }
            function validateForm() {
                const contactNumber = document.getElementById('contact').value;
                const date = document.getElementById('date').value;
                const name = document.getElementById('name').value;

                if (contactNumber.length > 11) {
                    alert("Contact number is too many digits.");
                    return false;
                } else if (contactNumber.length < 11) {
                    alert("Contact number must be 11 digits.");
                    return false;
                }

                if (!date) {
                    alert("Please select a valid date.");
                    return false;
                }

                const [year, month, day] = date.split('-').map(Number);

                if (year < 2024 || year > 2100) {
                    alert("Year must be between 2024 and 2100.");
                    return false;
                }

                if (month < 1 || month > 12) {
                    alert("Month must be between 01 and 12.");
                    return false;
                }

                const daysInMonth = new Date(year, month, 0).getDate();
                if (day < 1 || day > daysInMonth) {
                    alert(`Day must be between 01 and ${daysInMonth} for the selected month.`);
                    return false;
                }

                if (name.length < 10 || name.length > 50) {
                    alert("Name must be between 10 and 50 characters long.");
                    return false;
                }

                return true;
            }
          </script>
        </div>
      </section>
    </div>
  </div>
</body>
</html>
