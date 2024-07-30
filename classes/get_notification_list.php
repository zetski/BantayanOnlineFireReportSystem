<?php
// Include database connection file
include 'db_connect.php'; // Adjust this path as needed

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to get list of pending requests
$sql = "SELECT id, title FROM request_list WHERE status = 0";
$result = $conn->query($sql);

$response = array();

if ($result->num_rows > 0) {
    // Output data of each row
    while ($row = $result->fetch_assoc()) {
        $response[] = array('id' => $row['id'], 'title' => $row['title']);
    }
}

// Close connection
$conn->close();

// Set Content-Type to application/json
header('Content-Type: application/json');
echo json_encode($response);
?>
