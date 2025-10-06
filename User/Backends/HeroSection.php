<?php
include "./Backends/DatabaseConnection.php";

$titles = [];
$intro = null;

try {
    $sql = "SELECT * FROM introduction LIMIT 1";
    $result = $conn->query($sql);
    if ($result && $result->num_rows > 0) {
        $intro = $result->fetch_assoc();
    }
} catch (Throwable $e) {
    error_log("Intro query error: " . $e->getMessage());
}

// if the intro is null, set default values
$full_name     = !empty($intro['full_name']) ? $intro['full_name'] : 'John Aron Cadag';
$bio           = !empty($intro['bio']) ? $intro['bio'] : "Hello! I'm a passionate IT student specializing in networking, web development, and IT support. I'm learning continuously to move into the tech industry.";
$profile_image = !empty($intro['profile_image']) ? $intro['profile_image'] : 'assets/profile.png';
$cv_link       = !empty($intro['cv_link']) ? $intro['cv_link'] : '';

if (!empty($intro['id'])) {
    $intro_id = intval($intro['id']);
    try {
        $titlesSql = "SELECT title FROM titles WHERE introduction_id = $intro_id ORDER BY created_at ASC";
        $titlesResult = $conn->query($titlesSql);
        if ($titlesResult && $titlesResult->num_rows > 0) {
            while ($row = $titlesResult->fetch_assoc()) {
                $titles[] = $row['title'];
            }
        }
    } catch (Throwable $e) {
        error_log("Titles query error: " . $e->getMessage());
    }
}

// to prevent empty typing effects so we set default titles
if (empty($titles)) {
    $titles = ['IT Student', 'Web Developer', 'Network Enthusiast'];
}

$titles_json = json_encode($titles, JSON_UNESCAPED_UNICODE);

?>