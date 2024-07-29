<?php
// Assuming you have a database connection $conn

$id = intval($_GET['id']);
$query = "SELECT * FROM request_list WHERE id = $id"; // Adjust the query as needed
$result = $conn->query($query);

if ($row = $result->fetch_assoc()) {
    $response = [
        'details' => '<p><strong>ID:</strong> ' . $row['id'] . '</p><p><strong>Message:</strong> ' . $row['message'] . '</p>' // Adjust the details format as needed
    ];
} else {
    $response = ['details' => 'No details found.'];
}

echo json_encode($response);
?>
