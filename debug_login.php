<?php
require_once 'includes/db.php';

$email = 'admin@talentnest.com';
$password = 'admin123';

echo "<h2>Deep Diagnostic for Admin Login</h2>";

// 1. Check Database Connection
if ($pdo) {
    echo "Database connection: <span style='color:green'>OK</span><br>";
} else {
    echo "Database connection: <span style='color:red'>FAILED</span><br>";
    exit;
}

// 2. Check User Existence (ignoring role for a moment)
$stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email");
$stmt->execute(['email' => $email]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    echo "User '$email' NOT FOUND in database.<br>";
    // Create it
    $hash = password_hash($password, PASSWORD_DEFAULT);
    $stmt = $pdo->prepare("INSERT INTO users (name, email, password, role) VALUES ('Admin', :email, :pass, 'admin')");
    $stmt->execute(['email' => $email, 'pass' => $hash]);
    echo "Created user '$email' with password '$password'.<br>";
    $user = ['password' => $hash, 'role' => 'admin']; // Mock for next steps
} else {
    echo "User found. ID: " . $user['id'] . "<br>";
}

// 3. Check Role
echo "Role in DB: '" . $user['role'] . "'<br>";
if ($user['role'] !== 'admin') {
    echo "Role mismatch! Fixing...<br>";
    $stmt = $pdo->prepare("UPDATE users SET role = 'admin' WHERE email = :email");
    $stmt->execute(['email' => $email]);
    echo "Role updated to 'admin'.<br>";
}

// 4. Check Password Hash
echo "Stored Hash: " . substr($user['password'], 0, 20) . "...<br>";
if (password_verify($password, $user['password'])) {
    echo "Password verify check: <span style='color:green'>MATCH</span><br>";
} else {
    echo "Password verify check: <span style='color:red'>NO MATCH</span><br>";
    echo "Resetting password...<br>";
    $newHash = password_hash($password, PASSWORD_DEFAULT);
    $stmt = $pdo->prepare("UPDATE users SET password = :pass WHERE email = :email");
    $stmt->execute(['pass' => $newHash, 'email' => $email]);
    echo "Password reset to '$password'.<br>";
}

// 5. Check for whitespace issues
$stmt = $pdo->prepare("SELECT * FROM users WHERE email LIKE :email");
$stmt->execute(['email' => '%' . $email . '%']);
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);
echo "<br>All users matching email pattern:<br>";
foreach ($users as $u) {
    echo "ID: " . $u['id'] . " | Email: '" . $u['email'] . "' | Role: '" . $u['role'] . "'<br>";
}

echo "<br><strong>Diagnostic complete. Try logging in now with:</strong><br>";
echo "Email: <strong>$email</strong><br>";
echo "Password: <strong>$password</strong><br>";
?>