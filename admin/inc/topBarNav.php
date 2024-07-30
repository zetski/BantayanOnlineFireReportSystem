<style>
  .user-img {
    position: absolute;
    height: 27px;
    width: 27px;
    object-fit: cover;
    left: -7%;
    top: -12%;
  }
  .btn-rounded {
    border-radius: 50px;
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
</style>
<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-light shadow text-sm">
  <!-- Left navbar links -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
    </li>
    <li class="nav-item d-none d-sm-inline-block">
      <a href="<?php echo base_url ?>" class="nav-link"><?php echo (!isMobileDevice()) ? $_settings->info('name') : $_settings->info('short_name'); ?> - Admin</a>
    </li>
  </ul>
  <!-- Right navbar links -->
  <ul class="navbar-nav ml-auto">
    <!-- Notification Bell -->
    <li class="nav-item">
      <div class="notification-container nav-link">
        <a href="./?page=requests&status=0" class="text-decoration-none">
          <i class="fas fa-bell"></i>
          <span class="badge bg-danger" id="notification-count">
            <?php echo format_num($pending_requests); ?>
          </span>
        </a>
      </div>
    </li>
    <!-- User Menu -->
    <li class="nav-item">
      <div class="btn-group nav-link">
        <button type="button" class="btn btn-rounded badge badge-light dropdown-toggle dropdown-icon" data-toggle="dropdown">
          <span><img src="<?php echo validate_image($_settings->userdata('avatar')) ?>" class="img-circle elevation-2 user-img" alt="User Image"></span>
          <span class="ml-3"><?php echo ucwords($_settings->userdata('firstname').' '.$_settings->userdata('lastname')) ?></span>
          <span class="sr-only">Toggle Dropdown</span>
        </button>
        <div class="dropdown-menu" role="menu">
          <a class="dropdown-item" href="<?php echo base_url.'admin/?page=user' ?>"><span class="fa fa-user"></span> My Account</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="<?php echo base_url.'/classes/Login.php?f=logout' ?>"><span class="fas fa-sign-out-alt"></span> Logout</a>
        </div>
      </div>
    </li>
  </ul>
</nav>
<!-- /.navbar -->

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
