<?php
session_start();
require_once '../includes/db.php';

if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'employer') {
    header("Location: ../login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';

    if ($action === 'post_job') {
        $title = trim($_POST['title']);
        $location = trim($_POST['location']);
        $job_type = $_POST['job_type'];
        $salary_range = trim($_POST['salary_range']);
        $description = trim($_POST['description']);
        $employer_id = $_SESSION['user_id'];

        if (empty($title) || empty($location) || empty($description)) {
            header("Location: ../post_job.php?error=Please fill in all required fields");
            exit();
        }

        try {
            $stmt = $pdo->prepare("INSERT INTO jobs (employer_id, title, location, job_type, salary_range, description) VALUES (:employer_id, :title, :location, :job_type, :salary_range, :description)");
            $stmt->execute([
                'employer_id' => $employer_id,
                'title' => $title,
                'location' => $location,
                'job_type' => $job_type,
                'salary_range' => $salary_range,
                'description' => $description
            ]);

            header("Location: ../employer_dashboard.php?success=Job posted successfully");
            exit();
        } catch (PDOException $e) {
            header("Location: ../post_job.php?error=Failed to post job. Please try again.");
            exit();
        }
    }
}
?>