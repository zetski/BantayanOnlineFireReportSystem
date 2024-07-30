<?php
// Define and assign value to $pending_requests before using it
$pending_requests = $conn->query("SELECT COUNT(id) FROM request_list WHERE status = 0")->fetch_row()[0];
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
      position: absolute;
      top: 20px;
      right: 20px;
    }
    .notification-container .fas.fa-bell {
      font-size: 24px;
    }
    .notification-container .badge {
      position: absolute;
      top: -10px;
      right: -10px;
      font-size: 12px;
      padding: 4px 6px;
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
      <a href="./?page=requests&status=0" class="text-decoration-none">
        <i class="fas fa-bell" style="font-size: 24px;"></i>
        <span class="badge bg-danger" id="notification-count" style="font-size: 12px;">
          <?php echo format_num($pending_requests); ?>
        </span>
      </a>
    </div>
    <hr>
    <div class="row h-100">
      <!-- Existing code for info-boxes -->
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
          <?php echo $conn->query("SELECT COUNT(id) FROM request_list WHERE status = 0")->fetch_row()[0]; ?>,
          <?php echo $conn->query("SELECT COUNT(id) FROM request_list WHERE status = 1")->fetch_row()[0]; ?>,
          <?php echo $conn->query("SELECT COUNT(id) FROM request_list WHERE status = 2")->fetch_row()[0]; ?>,
          <?php echo $conn->query("SELECT COUNT(id) FROM request_list WHERE status = 3")->fetch_row()[0]; ?>,
          <?php echo $conn->query("SELECT COUNT(id) FROM request_list WHERE status = 4")->fetch_row()[0]; ?>
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
  </script>
  <script>
    function markAsRead(notificationId) {
        // Send AJAX request to mark notification as read
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'mark_as_read.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    // Reload the notification bell after marking as read
                    var form = document.createElement('form');
                    form.setAttribute('method', 'post');
                    form.setAttribute('action', 'message_form.php?id=' + notificationId); // Corrected syntax

                    // Create an input field to hold the message ID
                    var input = document.createElement('input');
                    input.setAttribute('type', 'hidden');
                    input.setAttribute('name', 'message_id');
                    input.setAttribute('value', notificationId);

                    // Append the input field to the form
                    form.appendChild(input);

                    // Append the form to the document body and submit it
                    document.body.appendChild(form);
                    form.submit();
                } else {
                    console.error('Error marking notification as read');
                }
            }
        };
        xhr.send('notification_id=' + notificationId);
    }
  </script>
<div class="noti__item js-item-menu">
    <i class="zmdi zmdi-notifications"></i>
    <?php
    include 'include/config.php';          

    // Get user ID from session
    $id = $_SESSION['main_id'];

    // Count the number of unread notifications specific to the user
    $unreadQuery = "SELECT COUNT(*) AS unread_count FROM notifications WHERE main_id = ? AND status = 'unread'";
    $unreadStmt = $bd->prepare($unreadQuery);
    $unreadStmt->bind_param('i', $id);
    $unreadStmt->execute();
    $unreadResult = $unreadStmt->get_result();
    $unreadData = $unreadResult->fetch_assoc();
    $unreadCount = $unreadData['unread_count'];

    // Fetch notifications specific to the user
    $rt = mysqli_query($bd, "SELECT * FROM notifications WHERE main_id = $id ORDER BY timestamp DESC");
    $num1 = mysqli_num_rows($rt);
    ?>
    <span class="quantity"><?php echo htmlentities($unreadCount); ?></span> <!-- Display count of unread notifications -->
    <div class="notifi-dropdown js-dropdown" style="max-height: 300px; overflow-y: auto;">
        <div class="notifi__title">
            <p>You have <?php echo htmlentities($unreadCount); ?> Unread Notifications</p>
        </div>
        <?php
        while ($notification = mysqli_fetch_assoc($rt)) {
            $class = $notification['status'] == 'read' ? 'read' : 'unread'; // Add 'unread' class for unread notifications
        ?>
            <div class="notifi__item <?php echo $class; ?>" id="notification_<?php echo $notification['id']; ?>" onclick="markAsRead(<?php echo $notification['id']; ?>)">
                <div class="bg-c1 img-cir img-40">
                    <i class="zmdi zmdi-email-open"></i>
                </div>
                <div class="content">
                    <p><?php echo htmlentities($notification['message']); ?><?php echo htmlentities($notification['clientname']); ?></p>
                    <span class="date"><?php echo htmlentities($notification['timestamp']); ?></span>
                </div>
            </div>
        <?php
        }
        ?>
        <div class="notifi__footer">
             <a href="alltasknoti.php?main_id=<?php echo $id; ?>">View All notifications</a>
        </div>
    </div>
</div>
</body>
</html>
