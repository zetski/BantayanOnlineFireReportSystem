<?php
header('Content-Type: application/json');

$response = ['status' => 'success', 'message' => 'Report submitted successfully'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $image_path = null;

    // Handle image upload
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['image']['tmp_name'];
        $fileName = $_FILES['image']['name'];
        $fileSize = $_FILES['image']['size'];
        $fileType = $_FILES['image']['type'];
        $fileNameCmps = explode(".", $fileName);
        $fileExtension = strtolower(end($fileNameCmps));

        $allowedfileExtensions = ['jpg', 'gif', 'png', 'jpeg'];
        if (in_array($fileExtension, $allowedfileExtensions)) {
            $uploadFileDir = '../uploads/';
            if (!is_dir($uploadFileDir)) {
                mkdir($uploadFileDir, 0777, true);
            }
            $newFileName = md5(time() . $fileName) . '.' . $fileExtension;
            $dest_path = $uploadFileDir . $newFileName;

            if (move_uploaded_file($fileTmpPath, $dest_path)) {
                $image_path = $dest_path;
            } else {
                $response = ['status' => 'failed', 'message' => 'Failed to move uploaded file.'];
                echo json_encode($response);
                exit();
            }
        } else {
            $response = ['status' => 'failed', 'message' => 'Invalid file extension.'];
            echo json_encode($response);
            exit();
        }
    }

    // Validate other form fields
    $fullname = isset($_POST['fullname']) ? trim($_POST['fullname']) : null;
    $contact = isset($_POST['contact']) ? trim($_POST['contact']) : null;
    $message = isset($_POST['message']) ? trim($_POST['message']) : null;
    $location = isset($_POST['location']) ? trim($_POST['location']) : null;

    if (!$fullname || !$contact || !$message || !$location) {
        $response = ['status' => 'failed', 'message' => 'All fields are required.'];
        echo json_encode($response);
        exit();
    }

    // Save to database
    try {
        $pdo = new PDO('mysql:host=localhost;dbname=your_database', 'username', 'password');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $pdo->prepare("INSERT INTO reports (fullname, contact, message, location, image) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$fullname, $contact, $message, $location, $image_path]);

        $response = ['status' => 'success', 'message' => 'Report submitted successfully'];
    } catch (Exception $e) {
        $response = ['status' => 'failed', 'message' => 'Failed to save report: ' . $e->getMessage()];
    }
}

echo json_encode($response);
?>
