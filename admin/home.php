<?php
// Define and assign value to $pending_requests before using it
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
    .notification-item .timestamp {
      font-size: 0.75rem;
      color: #6c757d;
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
      <span class="badge bg-danger" id="notification-count" style="font-size: 12px;">
        <?php echo format_num($pending_requests); ?>
      </span>
      <div class="notification-dropdown" id="notification-dropdown">
        <?php
        // Fetch notifications
        $result = $conn->query("SELECT * FROM request_list WHERE `status` = 0 ORDER BY created_at DESC");
        if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
            echo '<div class="notification-item">
                    <a href="./?page=requests&status=0&id='.$row['id'].'">
                      <strong>New Request</strong><br>
                      <span class="timestamp">'.date('F j, Y, g:i a', strtotime($row['created_at'])).'</span>
                    </a>
                  </div>';
          }
        } else {
          echo '<div class="notification-item">No new notifications.</div>';
        }
        ?>
      </div>
    </div>
    <hr>
    <div class="row h-100">
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

      <div class="col-12 col-sm-4 col-md-4 mb-3 h-100">
        <a href="./?page=requests&status=0" class="text-decoration-none h-100 d-block">
          <div class="info-box h-100 d-flex flex-column justify-content-center">
            <span class="info-box-icon bg-gradient-secondary">
              <i class="fas fa-hourglass-half"></i>
            </span>
            <div class="info-box-content">
              <span class="info-box-text">Pending Requests</span>
              <span class="info-box-number text-center h5">
                <?php 
                  $request = $conn->query("SELECT id FROM request_list where `status` = 0")->num_rows;
                  echo format_num($request);
                ?>
              </span>
            </div>
          </div>
        </a>
      </div>

      <div class="col-12 col-sm-4 col-md-4 mb-3 h-100">
        <a href="./?page=requests&status=1" class="text-decoration-none h-100 d-block">
          <div class="info-box h-100 d-flex flex-column justify-content-center">
            <span class="info-box-icon bg-gradient-secondary">
              <i class="fas fa-tasks"></i>
            </span>
            <div class="info-box-content">
              <span class="info-box-text">Assigned Requests</span>
              <span class="info-box-number text-center h5">
                <?php 
                  $request = $conn->query("SELECT id FROM request_list where `status` = 1")->num_rows;
                  echo format_num($request);
                ?>
              </span>
            </div>
          </div>
        </a>
      </div>

      <div class="col-12 col-sm-4 col-md-4 mb-3 h-100">
        <a href="./?page=requests&status=2" class="text-decoration-none h-100 d-block">
          <div class="info-box h-100 d-flex flex-column justify-content-center">
            <span class="info-box-icon bg-gradient-secondary">
              <i class="fas fa-truck"></i>
            </span>
            <div class="info-box-content">
              <span class="info-box-text">Team OTW Requests</span>
              <span class="info-box-number text-center h5">
                <?php 
                  $request = $conn->query("SELECT id FROM request_list where `status` = 2")->num_rows;
                  echo format_num($request);
                ?>
              </span>
            </div>
          </div>
        </a>
      </div>

      <div class="col-12 col-sm-4 col-md-4 mb-3 h-100">
        <a href="./?page=requests&status=3" class="text-decoration-none h-100 d-block">
          <div class="info-box h-100 d-flex flex-column justify-content-center">
            <span class="info-box-icon bg-gradient-secondary">
              <i class="fas fa-wrench"></i>
            </span>
            <div class="info-box-content">
              <span class="info-box-text">On-Progress Requests</span>
              <span class="info-box-number text-center h5">
                <?php 
                  $request = $conn->query("SELECT id FROM request_list where `status` = 3")->num_rows;
                  echo format_num($request);
                ?>
              </span>
            </div>
          </div>
        </a>
      </div>

      <div class="col-12 col-sm-4 col-md-4 mb-3 h-100">
        <a href="./?page=requests&status=4" class="text-decoration-none h-100 d-block">
          <div class="info-box h-100 d-flex flex-column justify-content-center">
            <span class="info-box-icon bg-gradient-secondary">
              <i class="fas fa-check"></i>
            </span>
            <div class="info-box-content">
              <span class="info-box-text">Completed Requests</span>
              <span class="info-box-number text-center h5">
                <?php 
                  $request = $conn->query("SELECT id FROM request_list where `status` = 4")->num_rows;
                  echo format_num($request);
                ?>
              </span>
            </div>
          </div>
        </a>
      </div>
    </div>
  </div>

  <!-- Latest Bootstrap 5.3.0 JS and Popper.js -->
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
    });
  </script>
</body>
</html>
