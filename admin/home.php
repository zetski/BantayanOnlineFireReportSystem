<?php
session_start();
require_once('../config.php');

// Check if admin is logged in
if (!isset($_SESSION['admin_id'])) {
    header('Location: login.php');
    exit();
}

// Fetch municipalities
$municipalities = $pdo->query('SELECT * FROM municipalities')->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .container {
            padding: 20px;
        }
        .panel {
            width: 30%;
            display: inline-block;
            vertical-align: top;
            margin: 10px;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        #map {
            width: 100%;
            height: 500px;
            margin-top: 20px;
        }
        #page-title {
            text-align: center;
            margin-bottom: 20px;
        }
    </style>
    <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_GOOGLE_MAPS_API_KEY"></script>
    <script>
        function initMap() {
            // Map options
            const mapOptions = {
                center: { lat: 11.1092, lng: 123.6684 }, // Center the map to a default location
                zoom: 10
            };

            // Create the map
            const map = new google.maps.Map(document.getElementById('map'), mapOptions);

            // Add markers for municipalities (you can adjust the coordinates as needed)
            const markers = [
                { position: { lat: 11.1521, lng: 123.6765 }, title: 'Santa Fe' },
                { position: { lat: 11.1340, lng: 123.6733 }, title: 'Bantayan' },
                { position: { lat: 11.1533, lng: 123.6544 }, title: 'Madridejos' }
            ];

            markers.forEach(marker => {
                new google.maps.Marker({
                    position: marker.position,
                    map: map,
                    title: marker.title
                });
            });
        }

        // Initialize map when the window loads
        window.onload = initMap;
    </script>
</head>
<body>
    <div class="container">
        <h1 id="page-title">Dashboard</h1>

        <?php foreach ($municipalities as $municipality): ?>
            <div class="panel">
                <h2><?php echo htmlspecialchars($municipality['name']); ?></h2>
                <p>Information for <?php echo htmlspecialchars($municipality['name']); ?>.</p>
                <h2><?php echo htmlspecialchars($municipality['name']); ?></h2>
                <p>Information for <?php echo htmlspecialchars($municipality['name']); ?>.</p>
                <h2><?php echo htmlspecialchars($municipality['name']); ?></h2>
                <p>Information for <?php echo htmlspecialchars($municipality['name']); ?>.</p>
                <!-- Add more content specific to the municipality here -->
            </div>
        <?php endforeach; ?>

        <div id="map"></div>
    </div>
</body>
</html>
