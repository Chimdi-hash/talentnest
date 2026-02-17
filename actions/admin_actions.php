<?php
session_start();
require_once '../includes/db.php';

// Check if user is logged in and is an admin
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'admin') {
    header("Location: ../login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';

    if ($action === 'reset_password') {
        $email = trim($_POST['email']);

        if (empty($email)) {
            header("Location: ../admin_dashboard.php?error=Email is required");
            exit();
        }

        // Check if user exists
        $stmt = $pdo->prepare("SELECT id, name FROM users WHERE email = :email");
        $stmt->execute(['email' => $email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$user) {
            header("Location: ../admin_dashboard.php?error=User not found");
            exit();
        }

        // Generate new password
        $new_password = bin2hex(random_bytes(4)); // 8 characters
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

        // Update password in database
        try {
            $stmt = $pdo->prepare("UPDATE users SET password = :password WHERE id = :id");
            $stmt->execute([
                'password' => $hashed_password,
                'id' => $user['id']
            ]);

            // Send email
            $to = $email;
            $subject = "Password Reset - TalentNest";
            $message = "Hello " . $user['name'] . ",\n\n";
            $message .= "Your password has been reset by an administrator.\n";
            $message .= "Your new password is: " . $new_password . "\n\n";
            $message .= "Please login and change your password immediately.\n\n";
            $message .= "Best regards,\nTalentNest Team";
            $headers = "From: no-reply@talentnest.com";

            if (mail($to, $subject, $message, $headers)) {
                header("Location: ../admin_dashboard.php?success=Password reset successfully and email sent.");
            } else {
                // Fallback if mail fails (e.g. local env) - show password in success message for testing
                header("Location: ../admin_dashboard.php?success=Password reset. New password: " . $new_password . " (Email failed to send)");
            }
            exit();

        } catch (PDOException $e) {
            header("Location: ../admin_dashboard.php?error=Database error: " . $e->getMessage());
            exit();
        }
    }
}
?>
