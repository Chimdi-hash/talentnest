<?php
require_once 'includes/db.php';

$email = 'admin@talentnest.com';
$password = 'admin123';

echo "Checking admin user...\n";

$stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email");
$stmt->execute(['email' => $email]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if ($user) {
    echo "User found. Role: " . $user['role'] . "\n";
    
    $newHash = password_hash($password, PASSWORD_DEFAULT);
    $update = $pdo->prepare("UPDATE users SET password = :pass, role = 'admin' WHERE id = :id");
    $update->execute(['pass' => $newHash, 'id' => $user['id']]);
    echo "Password reset to 'admin123' and role ensured as 'admin'.\n";
} else {
    echo "User not found. Creating...\n";
    $hash = password_hash($password, PASSWORD_DEFAULT);
    $insert = $pdo->prepare("INSERT INTO users (name, email, password, role) VALUES ('Admin User', :email, :pass, 'admin')");
    $insert->execute(['email' => $email, 'pass' => $hash]);
    echo "Admin user created.\n";
}
?>