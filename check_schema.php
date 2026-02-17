<?php
require_once 'includes/db.php';

echo "<h2>Database Schema Check</h2>";

try {
    $stmt = $pdo->query("DESCRIBE users");
    $columns = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo "<table border='1'><tr><th>Field</th><th>Type</th></tr>";
    foreach ($columns as $col) {
        echo "<tr><td>" . htmlspecialchars($col['Field']) . "</td><td>" . htmlspecialchars($col['Type']) . "</td></tr>";
    }
    echo "</table>";
    
    // Check specifically for password length issue
    foreach ($columns as $col) {
        if ($col['Field'] === 'password') {
            if (strpos($col['Type'], 'varchar') !== false) {
                preg_match('/\d+/', $col['Type'], $matches);
                if (isset($matches[0]) && $matches[0] < 60) {
                    echo "<h3 style='color:red'>CRITICAL ISSUE: Password column is too short!</h3>";
                    echo "Current length: " . $matches[0] . ". Needs to be at least 60 (preferably 255).<br>";
                    echo "Fixing now...<br>";
                    $pdo->exec("ALTER TABLE users MODIFY COLUMN password VARCHAR(255)");
                    echo "Fixed. Please reset password again using the fix script.";
                } else {
                    echo "<h3 style='color:green'>Password column length is OK (" . $matches[0] . ")</h3>";
                }
            }
        }
    }
    
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>