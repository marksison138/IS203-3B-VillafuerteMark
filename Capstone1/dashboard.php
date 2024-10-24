<!DOCTYPE html>  
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Beauty on Top / Dashboard</title>
  <link rel="stylesheet" href="style1.css">
  <link rel="stylesheet" href="style4.css">
  <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.5/main.min.css' />
  <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.5/main.min.js'></script>
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
        <h1>Welcome to Beauty on Top!></h1>
        <div class="user-info">
          <p>☰</p>
          <div class="dropdown-content">
            <a href="logout.php" onclick="return confirmLogout()">Logout</a>
            <a href="print.php">Print this page</a>
          </div>
        </div>
      </header>

      <section class="dashboard">
        <div class="carousel">
          <div class="carousel-item active">
            <h2>Book Your Appointment Now!</h2><br>
            <p>Select a service, provider, and time to schedule.</p>
          </div>
        </div>

        <div class="appointments">
          <center><h2>Services</h2></center><br>
          <div class="appointment-grid">
            <div class="appointment-card">
              <p>Haircut</p>
              <img src="haircut.jpg" alt="Haircut">
            </div>
            <div class="appointment-card">
              <p>Hair Style</p>
              <img src="hairstyle.jpg" alt="Hair Style">
            </div>
            <div class="appointment-card">
              <p>Manicure</p>
              <img src="manicure.jpg" alt="Manicure">
            </div>
            <div class="appointment-card">
              <p>MakeUp</p>
              <img src="makeup.jpg" alt="MakeUp">
            </div>
          </div>
        </div>
      </section>
    </div>

    <aside class="right-sidebar">
      <p>━━━━━━━━━━━━</p>
      <div class="calendar">
        <div class="month">
          <div class="prev" onclick="changeMonth(-1)">&#10094;</div>
          <h2 id="month-title">October</h2>
          <div class="next" onclick="changeMonth(1)">&#10095;</div>
        </div>
        <table>
          <thead>
            <tr>
              <th>Mo</th>
              <th>Tu</th>
              <th>We</th>
              <th>Th</th>
              <th>Fr</th>
              <th>Sa</th>
              <th>Su</th>
            </tr>
          </thead>
          <tbody id="days"></tbody>
        </table>
        <script>
          const monthNames = ["January", "February", "March", "April", "May", "June", 
                              "July", "August", "September", "October", "November", "December"];
          let currentMonth = new Date().getMonth();
          let currentYear = new Date().getFullYear();

          function changeMonth(direction) {
            currentMonth += direction;

            if (currentMonth < 0) {
              currentMonth = 11;
              currentYear--;
            } else if (currentMonth > 11) {
              currentMonth = 0;
              currentYear++;
            }

            updateCalendar();
          }

          function updateCalendar() {
            const monthTitle = document.getElementById('month-title');
            const daysContainer = document.getElementById('days');

            monthTitle.innerText = monthNames[currentMonth] + " " + currentYear;
            daysContainer.innerHTML = "";

            const daysInMonth = new Date(currentYear, currentMonth + 1, 0).getDate();
            const startDay = new Date(currentYear, currentMonth, 1).getDay();

            let row = document.createElement('tr');

            for (let i = 0; i < (startDay === 0 ? 7 : startDay - 1); i++) {
              row.appendChild(document.createElement('td'));
            }

            for (let day = 1; day <= daysInMonth; day++) {
              const dayCell = document.createElement('td');
              dayCell.innerText = day;
              dayCell.onclick = function() {
                document.querySelectorAll('.days td').forEach(d => d.classList.remove('active'));
                dayCell.classList.add('active');
              };
              row.appendChild(dayCell);

              if ((startDay + day - 2) % 7 === 6) {
                daysContainer.appendChild(row);
                row = document.createElement('tr');
              }
            }

            if (row.children.length > 0) {
              daysContainer.appendChild(row);
            }
          }

          updateCalendar();
        </script>
        <script>
          function confirmLogout() {
            return confirm("Are you sure you want to log out?");
          }
        </script>
      </div><br>
      <p>━━━━━━━━━━━━</p>
      <div class="todo-list">
        <h3>Reach Us</h3><br>
        <ul>
          <li>⚲ San Vicente, Santa Rita, Pampanga</li><br>
          <li>✆ 0927-488-9670</li><br>
          <li>ⓕ Alvin Galang Garcia</li>
        </ul>
      </div>
    </aside>
  </div>
</body>
</html>
