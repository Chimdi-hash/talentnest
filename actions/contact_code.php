<?php
session_start();
require_once '../includes/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $message = trim($_POST['message']);

    if (empty($name) || empty($email) || empty($message)) {
        header("Location: ../faq.php?error=All fields are required");
        exit();
    }

    try {
        $stmt = $pdo->prepare("INSERT INTO contact_messages (name, email, message) VALUES (:name, :email, :message)");
        $stmt->execute([
            'name' => $name,
            'email' => $email,
            'message' => $message
        ]);

        header("Location: ../faq.php?success=Message sent successfully. We will get back to you soon.");
        exit();
    } catch (PDOException $e) {
        header("Location: ../faq.php?error=Failed to send message. Please try again.");
        exit();
    }
} else {
    header("Location: ../faq.php");
    exit();
}
?>