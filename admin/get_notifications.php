<?php
// Assuming you have a database connection $conn

$query = "SELECT id, message FROM request_list WHERE `status` = 0 ORDER BY created_at DESC LIMIT 10"; // Adjust the query as needed
$result = $conn->query($query);

$notifications = [];
while ($row = $result->fetch_assoc()) {
    $notifications[] = $row;
}

$response = [
    'count' => count($notifications),
    'notifications' => $notifications
];

echo json_encode($response);
?>
