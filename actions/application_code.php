<?php
session_start();
require_once '../includes/db.php';

if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'seeker') {
    header("Location: ../login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['apply_job'])) {
    $job_id = $_POST['job_id'];
    $seeker_id = $_SESSION['user_id'];
    $cover_letter = trim($_POST['cover_letter']);
    
    // File upload handling
    $upload_dir = '../uploads/resumes/';
    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0777, true);
    }

    if (isset($_FILES['resume']) && $_FILES['resume']['error'] === UPLOAD_ERR_OK) {
        $file_tmp = $_FILES['resume']['tmp_name'];
        $file_name = time() . '_' . $_FILES['resume']['name'];
        $file_path = $upload_dir . $file_name;
        $db_path = 'uploads/resumes/' . $file_name;

        if (move_uploaded_file($file_tmp, $file_path)) {
            try {
                $stmt = $pdo->prepare("INSERT INTO applications (job_id, seeker_id, cover_letter, resume_path) VALUES (:job_id, :seeker_id, :cover_letter, :resume_path)");
                $stmt->execute([
                    'job_id' => $job_id,
                    'seeker_id' => $seeker_id,
                    'cover_letter' => $cover_letter,
                    'resume_path' => $db_path
                ]);

                header("Location: ../seeker_profile.php?success=Application submitted successfully");
                exit();
            } catch (PDOException $e) {
                header("Location: ../job_details.php?id=$job_id&error=Application failed. You may have already applied.");
                exit();
            }
        } else {
            header("Location: ../job_details.php?id=$job_id&error=Failed to upload resume");
            exit();
        }
    } else {
        header("Location: ../job_details.php?id=$job_id&error=Resume is required");
        exit();
    }
}
?>