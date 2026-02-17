<?php
session_start();
require_once '../includes/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';

    if ($action === 'register') {
        $name = trim($_POST['name']);
        $email = trim($_POST['email']);
        $password = $_POST['password'];
        $role = $_POST['role'];

        // Basic validation
        if (empty($name) || empty($email) || empty($password) || empty($role)) {
            header("Location: ../register.php?error=All fields are required");
            exit();
        }

        // Check if email exists
        $stmt = $pdo->prepare("SELECT id FROM users WHERE email = :email");
        $stmt->execute(['email' => $email]);
        if ($stmt->fetch()) {
            header("Location: ../register.php?error=Email already registered");
            exit();
        }

        // Hash password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Insert user
        try {
            $stmt = $pdo->prepare("INSERT INTO users (name, email, password, role) VALUES (:name, :email, :password, :role)");
            $stmt->execute([
                'name' => $name,
                'email' => $email,
                'password' => $hashed_password,
                'role' => $role
            ]);

            header("Location: ../login.php?success=Account created successfully. Please login.");
            exit();
        } catch (PDOException $e) {
            header("Location: ../register.php?error=Registration failed. Please try again.");
            exit();
        }

    } elseif ($action === 'login') {
        $email = trim($_POST['email']);
        $password = $_POST['password'];

        if (empty($email) || empty($password)) {
            header("Location: ../login.php?error=All fields are required");
            exit();
        }

        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->execute(['email' => $email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            // Prevent admin login from main login page
            if ($user['role'] === 'admin') {
                header("Location: ../login.php?error=Invalid email or password"); // Pretend it doesn't exist or just fail
                exit();
            }

            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['name'];
            $_SESSION['user_role'] = $user['role'];
            $_SESSION['user_email'] = $user['email'];

            // Redirect based on role
            if ($user['role'] === 'employer') {
                header("Location: ../employer_dashboard.php");
            } else {
                header("Location: ../index.php");
            }
            exit();
        } else {
            header("Location: ../login.php?error=Invalid email or password");
            exit();
        }
    } elseif ($action === 'admin_login') {
        $email = trim($_POST['email']);
        $password = $_POST['password'];

        if (empty($email) || empty($password)) {
            header("Location: ../admin_login.php?error=All fields are required");
            exit();
        }

        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email AND role = 'admin'");
        $stmt->execute(['email' => $email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$user) {
            // Debugging: Check if user exists with ANY role
            $stmt2 = $pdo->prepare("SELECT * FROM users WHERE email = :email");
            $stmt2->execute(['email' => $email]);
            $anyUser = $stmt2->fetch(PDO::FETCH_ASSOC);
            
            if ($anyUser) {
                header("Location: ../admin_login.php?error=User exists but role is '" . $anyUser['role'] . "', not 'admin'");
            } else {
                header("Location: ../admin_login.php?error=User not found with email: " . htmlspecialchars($email));
            }
            exit();
        }

        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['name'];
            $_SESSION['user_role'] = $user['role'];
            $_SESSION['user_email'] = $user['email'];

            header("Location: ../admin_dashboard.php");
            exit();
        } else {
            header("Location: ../admin_login.php?error=Password incorrect for user: " . htmlspecialchars($email));
            exit();
        }
    }
}

// Logout
if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: ../login.php");
    exit();
}
?>