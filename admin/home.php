<?php
// Define and assign value to $pending_requests before using it
$pending_requests = $conn->query("SELECT COUNT(id) FROM request_list WHERE `status` = 0")->fetch_row()[0];
?>

<h3 style="display: inline-block; margin-right: 20px;">
  Welcome, <?php echo $_settings->userdata('firstname')." ".$_settings->userdata('lastname') ?>!
</h3>
<div class="notification-container">
  <a href="./?page=requests&status=0" class="text-decoration-none">
    <i class="fas fa-bell" style="font-size: 24px;"></i>
    <span class="badge badge-danger" id="notification-count" style="font-size: 12px;">
      <?php echo format_num($pending_requests); ?>
    </span>
  </a>
</div>
<hr>
<div class="row">
  <div class="col-12 col-sm-4 col-md-4">
    <a href="./?page=teams" class="text-decoration-none">
      <div class="info-box">
        <span class="info-box-icon bg-gradient-danger elevation-1"><i class="fas fa-users"></i></span>
        <div class="info-box-content">
          <span class="info-box-text">Control Teams</span>
          <span class="info-box-number text-right h5">
            <?php 
              $team = $conn->query("SELECT * FROM team_list where delete_flag = 0")->num_rows;
              echo format_num($team);
            ?>
          </span>
        </div>
      </div>
    </a>
  </div>

  <div class="col-12 col-sm-4 col-md-4">
    <a href="./?page=requests&status=0" class="text-decoration-none">
      <div class="info-box">
        <span class="info-box-icon bg-gradient-secondary elevation-1"><i class="fas fa-fire"></i></span>
        <div class="info-box-content">
          <span class="info-box-text">Pending Requests</span>
          <span class="info-box-number text-right h5">
            <?php 
              $request = $conn->query("SELECT id FROM request_list where `status` = 0")->num_rows;
              echo format_num($request);
            ?>
          </span>
        </div>
      </div>
    </a>
  </div>

  <div class="col-12 col-sm-4 col-md-4">
    <a href="./?page=requests&status=1" class="text-decoration-none">
      <div class="info-box">
        <span class="info-box-icon bg-gradient-light elevation-1"><i class="fas fa-fire"></i></span>
        <div class="info-box-content">
          <span class="info-box-text">Assigned Requests</span>
          <span class="info-box-number text-right h5">
            <?php 
              $request = $conn->query("SELECT id FROM request_list where `status` = 1")->num_rows;
              echo format_num($request);
            ?>
          </span>
        </div>
      </div>
    </a>
  </div>

  <div class="col-12 col-sm-4 col-md-4">
    <a href="./?page=requests&status=2" class="text-decoration-none">
      <div class="info-box">
        <span class="info-box-icon bg-gradient-info elevation-1"><i class="fas fa-fire"></i></span>
        <div class="info-box-content">
          <span class="info-box-text">Team OTW Requests</span>
          <span class="info-box-number text-right h5">
            <?php 
              $request = $conn->query("SELECT id FROM request_list where `status` = 2")->num_rows;
              echo format_num($request);
            ?>
          </span>
        </div>
      </div>
    </a>
  </div>

  <div class="col-12 col-sm-4 col-md-4">
    <a href="./?page=requests&status=3" class="text-decoration-none">
      <div class="info-box">
        <span class="info-box-icon bg-gradient-primary elevation-1"><i class="fas fa-fire"></i></span>
        <div class="info-box-content">
          <span class="info-box-text">On-Progress Requests</span>
          <span class="info-box-number text-right h5">
            <?php 
              $request = $conn->query("SELECT id FROM request_list where `status` = 3")->num_rows;
              echo format_num($request);
            ?>
          </span>
        </div>
      </div>
    </a>
  </div>

  <div class="col-12 col-sm-4 col-md-4">
    <a href="./?page=requests&status=4" class="text-decoration-none">
      <div class="info-box">
        <span class="info-box-icon bg-gradient-teal elevation-1"><i class="fas fa-fire"></i></span>
        <div class="info-box-content">
          <span class="info-box-text">Completed Requests</span>
          <span class="info-box-number text-right h5">
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

<style>
  .notification-container {
    display: inline-block;
    position: absolute;
    top: 20px;
    right: 20px;
  }
  .notification-container .fas.fa-bell {
    font-size: 24px; /* Adjusted size */
  }
  .notification-container .badge {
    position: absolute;
    top: -10px;
    right: -10px;
    font-size: 12px; /* Adjusted size */
    padding: 4px 6px; /* Optional: Adjust padding for badge */
  }
</style>

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
</script>
