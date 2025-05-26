<?php
require 'db.php';

$name    = $_POST['fullname'] ?? '';
$email   = $_POST['email'] ?? '';
$subject = $_POST['subject'] ?? '';
$message = $_POST['message'] ?? '';

if ($name && $email && $message) {
    try {
        $stmt = $pdo->prepare("INSERT INTO contacts (name, email, subject, message) VALUES (?, ?, ?, ?)");
        $stmt->execute([$name, $email, $subject, $message]);
        header("Location: index.php?success=1#contact");
        exit;
    } catch (PDOException $e) {
        // Log error or handle as needed
        header("Location: index.php?error=1#contact");
        exit;
    }
} else {
    header("Location: index.php?error=1#contact");
    exit;
}
?>