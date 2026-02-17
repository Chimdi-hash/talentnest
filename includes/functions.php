<?php
require_once 'db.php';

function getAllJobs($limit = 10) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT jobs.*, users.name as company_name, users.profile_image as company_logo FROM jobs JOIN users ON jobs.employer_id = users.id ORDER BY created_at DESC LIMIT :limit");
    $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function searchJobs($keyword = '', $location = '', $type = '', $sort = '', $limit = 20) {
    global $pdo;
    $sql = "SELECT jobs.*, users.name as company_name, users.profile_image as company_logo 
            FROM jobs 
            JOIN users ON jobs.employer_id = users.id 
            WHERE 1=1";
    $params = [];

    if (!empty($keyword)) {
        $sql .= " AND (jobs.title LIKE :keyword OR jobs.description LIKE :keyword OR users.name LIKE :keyword)";
        $params[':keyword'] = "%$keyword%";
    }

    if (!empty($location)) {
        $sql .= " AND jobs.location LIKE :location";
        $params[':location'] = "%$location%";
    }

    if (!empty($type)) {
        $sql .= " AND jobs.job_type = :type";
        $params[':type'] = $type;
    }
    
    if ($sort === 'salary_desc') {
        // Best effort sort by salary
        $sql .= " ORDER BY CAST(REPLACE(REPLACE(salary_range, ',', ''), '₦', '') AS UNSIGNED) DESC";
    } else {
        $sql .= " ORDER BY jobs.created_at DESC";
    }

    $sql .= " LIMIT :limit";
    $params[':limit'] = $limit;

    $stmt = $pdo->prepare($sql);
    
    foreach ($params as $key => $value) {
        if ($key === ':limit') {
            $stmt->bindValue($key, $value, PDO::PARAM_INT);
        } else {
            $stmt->bindValue($key, $value);
        }
    }
    
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getJobById($id) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT jobs.*, users.name as company_name, users.profile_image as company_logo, users.email as company_email FROM jobs JOIN users ON jobs.employer_id = users.id WHERE jobs.id = :id");
    $stmt->execute(['id' => $id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function getJobsByEmployer($employer_id) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM jobs WHERE employer_id = :employer_id ORDER BY created_at DESC");
    $stmt->execute(['employer_id' => $employer_id]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getUserById($id) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM users WHERE id = :id");
    $stmt->execute(['id' => $id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function getApplicationCountForJob($job_id) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM applications WHERE job_id = :job_id");
    $stmt->execute(['job_id' => $job_id]);
    return $stmt->fetchColumn();
}

function formatShortNumber($num) {
    $num = (float)preg_replace('/[^0-9.]/', '', $num);
    if ($num >= 1000000) {
        return round($num / 1000000, 1) . 'M';
    }
    if ($num >= 1000) {
        return round($num / 1000) . 'k';
    }
    return $num;
}

function formatSalary($salary) {
    if (empty($salary)) return 'Not specified';
    
    // Handle ranges like "350000 - 500000"
    if (strpos($salary, '-') !== false) {
        $parts = explode('-', $salary);
        $min = formatShortNumber(trim($parts[0]));
        $max = formatShortNumber(trim($parts[1]));
        return '₦' . $min . ' - ' . $max;
    }
    
    // Handle single numbers
    if (is_numeric(str_replace([',', ' '], '', $salary))) {
        return '₦' . formatShortNumber($salary);
    }
    
    return $salary;
}

function timeAgo($datetime) {
    $time = strtotime($datetime);
    $now = time();
    $diff = $now - $time;
    
    if ($diff < 60) {
        return 'Just now';
    } elseif ($diff < 3600) {
        return floor($diff / 60) . 'm ago';
    } elseif ($diff < 86400) {
        return floor($diff / 3600) . 'h ago';
    } elseif ($diff < 604800) {
        return floor($diff / 86400) . 'd ago';
    } else {
        return date('M j, Y', $time);
    }
}
?>