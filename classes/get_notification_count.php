<?php
// Include database connection file
include 'db_connect.php'; // Adjust this path as needed

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to count pending requests
$sql = "SELECT COUNT(id) AS count FROM request_list WHERE status = 0";
$result = $conn->query($sql);

$response = array();

if ($result->num_rows > 0) {
    // Output data of each row
    while ($row = $result->fetch_assoc()) {
        $response['count'] = $row['count'];
    }
} else {
    $response['count'] = 0;
}

// Close connection
$conn->close();

// Set Content-Type to application/json
header('Content-Type: application/json');
echo json_encode($response);
?>
