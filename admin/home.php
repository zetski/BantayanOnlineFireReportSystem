<?php
// Fetch pending requests count
$pending_requests = $conn->query("SELECT COUNT(id) FROM request_list WHERE `status` = 0")->fetch_row()[0];

// Fetch notifications
$notifications_query = "SELECT id, message FROM request_list WHERE `status` = 0 ORDER BY created_at DESC LIMIT 10"; // Adjust query as needed
$notifications_result = $conn->query($notifications_query);

$notifications = [];
while ($row = $notifications_result->fetch_assoc()) {
    $notifications[] = $row;
}
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
      position: relative;
      display: inline-block;
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
    .dropdown-menu {
      min-width: 300px;
      max-height: 400px;
      overflow-y: auto;
    }
    .dropdown-item {
      cursor: pointer;
    }
    .dropdown-item:hover {
      background-color: #f8f9fa;
    }
  </style>
</head>
<body class="d-flex flex-column min-vh-100">
  <div class="container my-3 flex-grow-1">
    <h3 style="display: inline-block; margin-right: 20px;">
      Welcome, <?php echo $_settings->userdata('firstname')." ".$_settings->userdata('lastname') ?>!
    </h3>
    <div class="notification-container">
      <a href="#" id="notificationBell" class="text-decoration-none" data-bs-toggle="dropdown" aria-expanded="false">
        <i class="fas fa-bell"></i>
        <span class="badge bg-danger" id="notification-count" style="font-size: 12px;">
          <?php echo format_num($pending_requests); ?>
        </span>
      </a>
      <ul class="dropdown-menu" aria-labelledby="notificationBell" id="notificationList">
        <?php if (count($notifications) > 0): ?>
          <?php foreach ($notifications as $notification): ?>
            <li class="dropdown-item" data-id="<?php echo $notification['id']; ?>">
              <?php echo htmlspecialchars($notification['message']); ?>
            </li>
          <?php endforeach; ?>
        <?php else: ?>
          <li class="dropdown-item">No notifications</li>
        <?php endif; ?>
      </ul>
    </div>
    <hr>
    <div class="row h-100">
      <!-- Your existing content -->
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

  <!-- Notification Detail Modal -->
  <div class="modal fade" id="notificationDetailModal" tabindex="-1" aria-labelledby="notificationDetailModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="notificationDetailModalLabel">Notification Details</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <!-- Notification details will be inserted here -->
        </div>
      </div>
    </div>
  </div>

  <!-- Latest Bootstrap 5.3.0 JS and Popper.js -->
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
    // Fetch and update notifications
    function fetchNotifications() {
      $.ajax({
        url: './get_notifications.php', // Replace with your endpoint to fetch notifications
        method: 'GET',
        success: function(response) {
          $('#notificationList').empty(); // Clear existing notifications
          if (response.notifications.length > 0) {
            response.notifications.forEach(notification => {
              $('#notificationList').append(`
                <li class="dropdown-item" data-id="${notification.id}">
                  ${notification.message}
                </li>
              `);
            });
            $('#notification-count').text(response.count);
          } else {
            $('#notificationList').append('<li class="dropdown-item">No notifications</li>');
          }
        },
        error: function(xhr, status, error) {
          console.error('Error fetching notifications');
        }
      });
    }

    // Fetch notifications on page load and every few seconds
    fetchNotifications();
    setInterval(fetchNotifications, 10000);

    // Handle notification click
    $(document).on('click', '.dropdown-item', function() {
      var id = $(this).data('id');
      // Fetch and show notification details
      $.ajax({
        url: './get_notification_details.php', // Replace with your endpoint to fetch notification details
        method: 'GET',
        data: { id: id },
        success: function(response) {
          $('#notificationDetailModal .modal-body').html(response.details);
          $('#notificationDetailModal').modal('show');
        },
        error: function(xhr, status, error) {
          console.error('Error fetching notification details');
        }
      });
    });
  </script>
</body>
</html>
