<?php
// Fetch all reported fire incidents
$notifications = $conn->query("SELECT * FROM request_list ORDER BY created_at DESC");

// Count of pending requests
$pending_requests = $conn->query("SELECT COUNT(id) FROM request_list WHERE `status` = 0")->fetch_row()[0];
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard</title>
  <!-- Latest Bootstrap 5.3.0 CSS -->
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
  <style>
    .notification-container {
      display: inline-block;
      position: relative;
    }
    .notification-container .fas.fa-bell {
      font-size: 24px;
      cursor: pointer;
    }
    .notification-container .badge {
      position: absolute;
      top: -10px;
      right: -10px;
      font-size: 12px;
      padding: 4px 6px;
    }
    .notification-dropdown {
      display: none;
      position: absolute;
      top: 100%;
      right: 0;
      width: 300px;
      max-height: 400px;
      overflow-y: auto;
      background-color: #fff;
      border: 1px solid #dee2e6;
      border-radius: .25rem;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
      z-index: 1000;
    }
    .notification-item {
      padding: 10px;
      border-bottom: 1px solid #dee2e6;
    }
    .notification-item:last-child {
      border-bottom: none;
    }
    .notification-item a {
      color: #000;
      text-decoration: none;
    }
    .notification-item a:hover {
      text-decoration: underline;
    }
    .info-box {
      display: flex;
      align-items: center;
      padding: 15px;
      margin-bottom: 15px;
      background-color: #f8f9fa;
      border: 1px solid #dee2e6;
      border-radius: .25rem;
    }
    .info-box-icon {
      display: flex;
      align-items: center;
      justify-content: center;
      width: 50px;
      height: 50px;
      border-radius: 50%;
      font-size: 24px;
      background-color: #e9ecef;
    }
    .info-box-content {
      flex: 1;
      margin-left: 15px;
    }
  </style>
</head>
<body class="d-flex flex-column min-vh-100">
  <div class="container my-3 flex-grow-1">
    <h3 style="display: inline-block; margin-right: 20px;">
      Welcome, <?php echo $_settings->userdata('firstname')." ".$_settings->userdata('lastname') ?>!
    </h3>
    <div class="notification-container">
      <i class="fas fa-bell" id="notification-bell"></i>
      <span class="badge bg-danger" id="notification-count">
        <?php echo format_num($pending_requests); ?>
      </span>
      <div class="notification-dropdown" id="notification-dropdown">
        <?php if ($notifications->num_rows > 0): ?>
          <?php while ($row = $notifications->fetch_assoc()): ?>
            <div class="notification-item">
              <a href="./?page=incident-details&id=<?php echo $row['id']; ?>">
                <strong>Incident Reported</strong><br>
                <span class="details"><?php echo htmlspecialchars($row['description']); ?></span><br>
                <span class="timestamp"><?php echo date('F j, Y, g:i a', strtotime($row['created_at'])); ?></span>
              </a>
            </div>
          <?php endwhile; ?>
        <?php else: ?>
          <div class="notification-item">No notifications available.</div>
        <?php endif; ?>
      </div>
    </div>
    <hr>
    <div class="row h-100">
      <!-- Info boxes here -->
      <div class="col-12 col-sm-4 col-md-4 mb-3 h-100">
        <a href="./?page=teams" class="text-decoration-none h-100 d-block">
          <div class="info-box h-100 d-flex flex-column justify-content-center">
            <span class="info-box-icon bg-gradient-secondary">
              <i class="fas fa-users"></i>
            </span>
            <div class="info-box-content">
              <span class="info-box-text">Control Teams</span>
              <span class="info-box-number text-center h5">
                <?php 
                  $team = $conn->query("SELECT * FROM team_list where delete_flag = 0")->num_rows;
                  echo format_num($team);
                ?>
              </span>
            </div>
          </div>
        </a>
      </div>

      <!-- Other info boxes here -->

    </div>
    <div class="row">
      <div class="col-12 col-md-6">
        <canvas id="barChart"></canvas>
      </div>
      <div class="col-12 col-md-6">
        <canvas id="lineChart"></canvas>
      </div>
    </div>
  </div>

  <!-- Latest Bootstrap 5.3.0 JS and Popper.js -->
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script>
    $(document).ready(function() {
      $('#notification-bell').on('click', function() {
        $('#notification-dropdown').toggle();
      });

      // Optional: Close dropdown if clicked outside
      $(document).on('click', function(event) {
        if (!$(event.target).closest('.notification-container').length) {
          $('#notification-dropdown').hide();
        }
      });

      // Example AJAX call to update notification count
      function updateNotificationCount() {
        $.ajax({
          url: 'get_notification_count.php', // Replace with your endpoint
          method: 'GET',
          success: function(response) {
            $('#notification-count').text(response.count);
          },
          error: function(xhr, status, error) {
            console.error('Error fetching notification count');
          }
        });
      }

      // Call the function initially and every few seconds (example)
      updateNotificationCount(); // Initial call
      setInterval(updateNotificationCount, 10000); // Repeat every 10 seconds

      // Data for charts
      var barData = {
        labels: ["Teams", "Pending Requests", "Assigned Requests", "OTW Requests", "On-Progress Requests", "Completed Requests"],
        datasets: [{
          label: 'Number of Requests',
          data: [
            <?php echo $team; ?>,
            <?php echo $conn->query("SELECT COUNT(id) FROM request_list WHERE `status` = 0")->fetch_row()[0]; ?>,
            <?php echo $conn->query("SELECT COUNT(id) FROM request_list WHERE `status` = 1")->fetch_row()[0]; ?>,
            <?php echo $conn->query("SELECT COUNT(id) FROM request_list WHERE `status` = 2")->fetch_row()[0]; ?>,
            <?php echo $conn->query("SELECT COUNT(id) FROM request_list WHERE `status` = 3")->fetch_row()[0]; ?>,
            <?php echo $conn->query("SELECT COUNT(id) FROM request_list WHERE `status` = 4")->fetch_row()[0]; ?>
          ],
          backgroundColor: [
            'rgba(255, 99, 132, 0.2)',
            'rgba(54, 162, 235, 0.2)',
            'rgba(255, 206, 86, 0.2)',
            'rgba(75, 192, 192, 0.2)',
            'rgba(153, 102, 255, 0.2)',
            'rgba(255, 159, 64, 0.2)'
          ],
          borderColor: [
            'rgba(255, 99, 132, 1)',
            'rgba(54, 162, 235, 1)',
            'rgba(255, 206, 86, 1)',
            'rgba(75, 192, 192, 1)',
            'rgba(153, 102, 255, 1)',
            'rgba(255, 159, 64, 1)'
          ],
          borderWidth: 1
        }]
      };

      var lineData = {
        labels: ["January", "February", "March", "April", "May", "June", "July"],
        datasets: [{
          label: 'Requests Over Time',
          data: [12, 19, 3, 5, 2, 3, 9], // Example data, replace with your actual data
          backgroundColor: 'rgba(54, 162, 235, 0.2)',
          borderColor: 'rgba(54, 162, 235, 1)',
          borderWidth: 1,
          fill: true
        }]
      };

      // Bar chart configuration
      var barConfig = {
        type: 'bar',
        data: barData,
        options: {
          scales: {
            y: {
              beginAtZero: true
            }
          }
        }
      };

      // Line chart configuration
      var lineConfig = {
        type: 'line',
        data: lineData,
        options: {
          scales: {
            y: {
              beginAtZero: true
            }
          }
        }
      };

      // Render charts
      var barChart = new Chart(document.getElementById('barChart'), barConfig);
      var lineChart = new Chart(document.getElementById('lineChart'), lineConfig);
    });
  </script>
</body>
</html>
