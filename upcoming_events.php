<?php
// Include your database connection
include './initialize.php';

// Fetch upcoming events (you can adjust the query based on your requirements)
$sql = "SELECT * FROM events_list WHERE event_date >= CURDATE() ORDER BY event_date ASC";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    echo '<div class="event-list">';
    while ($row = mysqli_fetch_assoc($result)) {
        echo '<div class="event-item">';
        echo '<h3>' . $row['event_name'] . '</h3>';
        echo '<p>' . $row['event_description'] . '</p>';
        echo '<p>Date: ' . date('F j, Y', strtotime($row['event_date'])) . '</p>';
        echo '<p>Location: ' . $row['municipality'] . ', ' . $row['barangay'] . ', ' . $row['sitio'] . '</p>';
        if ($row['event_image']) {
            echo '<img src="' . $row['event_image'] . '" alt="' . $row['event_name'] . '" style="width: 100%; height: auto;">';
        }
        echo '</div>';
        echo '<hr>'; // Add a line to separate events
    }
    echo '</div>';
} else {
    echo '<p>No upcoming events at the moment.</p>';
}

// Close the database connection
mysqli_close($conn);
?>
