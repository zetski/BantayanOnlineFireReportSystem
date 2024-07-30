<?php
if(!defined('DB_SERVER')){
    require_once("../initialize.php");
}

class DBConnection {

    private $host = "127.0.0.1:3306";
    private $username = "u510162695_ofrs_db";
    private $password = "1Ofrs_db";
    private $database = "u510162695_ofrs_db";
    
    public $conn;
    
    public function __construct() {
        if (!isset($this->conn)) {
            $this->conn = new mysqli($this->host, $this->username, $this->password, $this->database);
            if ($this->conn->connect_error) {
                echo 'Cannot connect to database server';
                exit;
            } 
        }    
    }

    public function __destruct() {
        $this->conn->close();
    }
}

$conn = new DBConnection()->conn;

// Function to get incident count per month
function getMonthlyData($conn) {
    $monthlyData = [];
    for ($month = 1; $month <= 12; $month++) {
        $start_date = date('Y') . "-" . str_pad($month, 2, "0", STR_PAD_LEFT) . "-01";
        $end_date = date('Y') . "-" . str_pad($month, 2, "0", STR_PAD_LEFT) . "-31";
        $query = $conn->query("SELECT COUNT(id) FROM request_list WHERE `date` BETWEEN '$start_date' AND '$end_date'");
        $monthlyData[] = $query->fetch_row()[0];
    }
    return $monthlyData;
}

$monthlyIncidents = getMonthlyData($conn);
$monthlyIncidentsJSON = json_encode($monthlyIncidents);
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
    /* Add your CSS styles here */
  </style>
</head>
<body class="d-flex flex-column min-vh-100">
  <div class="container my-3 flex-grow-1">
    <h3>Welcome, <?php echo $_settings->userdata('firstname')." ".$_settings->userdata('lastname') ?>!</h3>
    <div class="notification-container">
      <a href="./?page=requests&status=0" class="text-decoration-none">
        <i class="fas fa-bell" style="font-size: 24px;"></i>
        <span class="badge bg-danger" id="notification-count">
          <?php echo format_num($pending_requests); ?>
        </span>
      </a>
    </div>
    <hr>
    <div class="row h-100">
      <!-- Add your existing info boxes here -->
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
          <?php echo $conn->query("SELECT COUNT(id) FROM team_list WHERE delete_flag = 0")->fetch_row()[0]; ?>,
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
      labels: ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"],
      datasets: [{
        label: 'Requests Over Time',
        data: <?php echo $monthlyIncidentsJSON; ?>,
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
</body>
</html>
