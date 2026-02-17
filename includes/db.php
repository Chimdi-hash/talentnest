<?php
$host = 'localhost';
$db_name = 'talentnest';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db_name", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    // If database does not exist, try to create it
    if ($e->getCode() == 1049) { // Unknown database
        try {
            $pdo = new PDO("mysql:host=$host", $username, $password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo->exec("CREATE DATABASE IF NOT EXISTS `$db_name`");
            $pdo->exec("USE `$db_name`");
            
            // Import database.sql
            $sqlFile = __DIR__ . '/../database.sql';
            if (file_exists($sqlFile)) {
                $sql = file_get_contents($sqlFile);
                $statements = array_filter(array_map('trim', explode(';', $sql)));
                foreach ($statements as $stmt) {
                    if (!empty($stmt)) {
                        $pdo->exec($stmt);
                    }
                }
            }
        } catch (PDOException $ex) {
            die("Connection failed: " . $ex->getMessage());
        }
    } else {
        die("Connection failed: " . $e->getMessage());
    }
}
?>