<?php
require_once('../config.php');

$pdo = new PDO('mysql:host=localhost;dbname=your_database', 'username', 'password');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $token = $_POST['token'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Check if token is valid and not expired
    $stmt = $pdo->prepare("SELECT email FROM password_resets WHERE token = ? AND expiry > NOW()");
    $stmt->execute([$token]);
    $reset = $stmt->fetch();

    if ($reset) {
        $email = $reset['email'];

        // Update user password
        $stmt = $pdo->prepare("UPDATE users SET password = ? WHERE email = ?");
        $stmt->execute([$password, $email]);

        // Remove the reset token
        $stmt = $pdo->prepare("DELETE FROM password_resets WHERE token = ?");
        $stmt->execute([$token]);

        echo 'Your password has been reset successfully.';
    } else {
        echo 'Invalid or expired token.';
    }
}
?>
