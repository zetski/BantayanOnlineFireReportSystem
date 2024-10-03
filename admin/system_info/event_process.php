<?php
// Handle form submission in event_process.php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Initialize the database connection (assuming $_settings includes DB connection)
    include '../initialize.php'; // Adjust this depending on your setup

    $event_name = $_POST['event_name'];
    $event_description = $_POST['event_description'];
    $event_date = $_POST['event_date'];
    $municipality = $_POST['municipality'];
    $barangay = $_POST['barangay'];
    $sitio = $_POST['sitio'];

    // Handling file upload for event image
    if (!empty($_FILES['event_image']['name'])) {
        $file_name = $_FILES['event_image']['name'];
        $file_tmp = $_FILES['event_image']['tmp_name'];
        $upload_path = '../uploads/'; // Make sure this folder is writable

        // Create the uploads directory if it doesn't exist
        if (!is_dir($upload_path)) {
            mkdir($upload_path, 0755, true);
        }

        $new_file_name = time() . "_" . $file_name; // Rename file to avoid conflicts
        $file_destination = $upload_path . $new_file_name;

        // Move the uploaded file to the destination
        if (move_uploaded_file($file_tmp, $file_destination)) {
            $event_image = $file_destination;
        }
    }

    // Insert the event data into the database
    $sql = "INSERT INTO events_list (event_name, event_description, event_date, municipality, barangay, sitio, event_image) 
            VALUES ('$event_name', '$event_description', '$event_date', '$municipality', '$barangay', '$sitio', '$event_image')";
    if (mysqli_query($conn, $sql)) {
        $_settings->set_flashdata('success', 'Event has been added successfully.');
        header('Location: ./upcoming_event.php'); // Redirect back to the homepage
    } else {
        echo "Error: " . mysqli_error($conn);
    }

    // Close the connection
    mysqli_close($conn);
}
?>
