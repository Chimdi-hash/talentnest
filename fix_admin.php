<?php
require_once 'includes/db.php';

echo "<h2>Admin Login Diagnostic</h2>";

$email = 'admin@talentnest.com';
$password = 'admin123';

// 1. Check if user exists
$stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email");
$stmt->execute(['email' => $email]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if ($user) {
    echo "User found: " . htmlspecialchars($user['name']) . " (Role: " . htmlspecialchars($user['role']) . ")<br>";
    
    // 2. Verify password
    if (password_verify($password, $user['password'])) {
        echo "Password verification: <span style='color:green'>SUCCESS</span><br>";
    } else {
        echo "Password verification: <span style='color:red'>FAILED</span><br>";
        echo "Current Hash: " . $user['password'] . "<br>";
        
        // 3. Fix password
        $newHash = password_hash($password, PASSWORD_DEFAULT);
        $update = $pdo->prepare("UPDATE users SET password = :pass WHERE id = :id");
        $update->execute(['pass' => $newHash, 'id' => $user['id']]);
        echo "Password has been reset to 'admin123'. Try logging in now.<br>";
    }
} else {
    echo "User '$email' NOT FOUND.<br>";
    
    // Create user if missing
    $hash = password_hash($password, PASSWORD_DEFAULT);
    $insert = $pdo->prepare("INSERT INTO users (name, email, password, role) VALUES ('Admin User', :email, :pass, 'admin')");
    $insert->execute(['email' => $email, 'pass' => $hash]);
    echo "Admin user created with password 'admin123'. Try logging in now.<br>";
}

// ALSO create admin@example.com just in case
$email2 = 'admin@example.com';
$stmt2 = $pdo->prepare("SELECT * FROM users WHERE email = :email");
$stmt2->execute(['email' => $email2]);
if (!$stmt2->fetch()) {
    $hash = password_hash($password, PASSWORD_DEFAULT);
    $insert = $pdo->prepare("INSERT INTO users (name, email, password, role) VALUES ('Admin User 2', :email, :pass, 'admin')");
    $insert->execute(['email' => $email2, 'pass' => $hash]);
    echo "Secondary admin (admin@example.com) created with password 'admin123'.<br>";
} else {
    // Update existing to be admin
    $hash = password_hash($password, PASSWORD_DEFAULT);
    $update = $pdo->prepare("UPDATE users SET password = :pass, role = 'admin' WHERE email = :email");
    $update->execute(['pass' => $hash, 'email' => $email2]);
    echo "Secondary admin (admin@example.com) updated to password 'admin123'.<br>";
}
?>