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
    #map {
      height: 400px; /* Adjust as needed */
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
      <div class="col-12 col-md-4 mb-3 h-100">
        <a href="./?page=municipalities&municipality=Santa%20Fe" class="text-decoration-none h-100 d-block">
          <div class="info-box h-100 d-flex flex-column justify-content-center">
            <span class="info-box-icon bg-gradient-secondary">
              <i class="fas fa-city"></i>
            </span>
            <div class="info-box-content">
              <span class="info-box-text">Santa Fe</span>
              <span class="info-box-number text-center h5">
                <?php 
                  // Replace with actual data query for Santa Fe
                  $santa_fe_requests = $conn->query("SELECT COUNT(id) FROM request_list WHERE municipality = 'Santa Fe'")->fetch_row()[0];
                  echo format_num($santa_fe_requests);
                ?>
              </span>
            </div>
          </div>
        </a>
      </div>

      <div class="col-12 col-md-4 mb-3 h-100">
        <a href="./?page=municipalities&municipality=Bantayan" class="text-decoration-none h-100 d-block">
          <div class="info-box h-100 d-flex flex-column justify-content-center">
            <span class="info-box-icon bg-gradient-secondary">
              <i class="fas fa-city"></i>
            </span>
            <div class="info-box-content">
              <span class="info-box-text">Bantayan</span>
              <span class="info-box-number text-center h5">
                <?php 
                  // Replace with actual data query for Bantayan
                  $bantayan_requests = $conn->query("SELECT COUNT(id) FROM request_list WHERE municipality = 'Bantayan'")->fetch_row()[0];
                  echo format_num($bantayan_requests);
                ?>
              </span>
            </div>
          </div>
        </a>
      </div>

      <div class="col-12 col-md-4 mb-3 h-100">
        <a href="./?page=municipalities&municipality=Madridejos" class="text-decoration-none h-100 d-block">
          <div class="info-box h-100 d-flex flex-column justify-content-center">
            <span class="info-box-icon bg-gradient-secondary">
              <i class="fas fa-city"></i>
            </span>
            <div class="info-box-content">
              <span class="info-box-text">Madridejos</span>
              <span class="info-box-number text-center h5">
                <?php 
                  // Replace with actual data query for Madridejos
                  $madridejos_requests = $conn->query("SELECT COUNT(id) FROM request_list WHERE municipality = 'Madridejos'")->fetch_row()[0];
                  echo format_num($madridejos_requests);
                ?>
              </span>
            </div>
          </div>
        </a>
      </div>
    </div>
    
    <!-- Map of Bantayan Island -->
    <div class="row">
      <div class="col-12">
        <h4>Bantayan Island Map</h4>
        <div id="map"></div>
      </div>
    </div>
  </div>

  <!-- Latest Bootstrap 5.3.0 JS and Popper.js -->
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_GOOGLE_MAPS_API_KEY"></script> <!-- Replace with your API key -->
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

    // Initialize the map
    function initMap() {
      var bantayan = {lat: 11.1264, lng: 123.1611}; // Coordinates for Bantayan Island
      var map = new google.maps.Map(document.getElementById('map'), {
        zoom: 10,
        center: bantayan
      });
      var marker = new google.maps.Marker({
        position: bantayan,
        map: map
      });
    }

    initMap();
  </script>
</body>
</html>
