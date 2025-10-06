<?php
include "../Backends/DatabaseConnection.php";

$introCount = $conn->query("SELECT COUNT(*) AS count FROM introduction")->fetch_assoc()['count'];
$projectsCount = $conn->query("SELECT COUNT(*) AS count FROM projects")->fetch_assoc()['count'];
$educationCount = $conn->query("SELECT COUNT(*) AS count FROM education")->fetch_assoc()['count'];
$experienceCount = $conn->query("SELECT COUNT(*) AS count FROM experiences")->fetch_assoc()['count'];
$skillsCount = $conn->query("SELECT COUNT(*) AS count FROM skills")->fetch_assoc()['count'];
$toolsCount = $conn->query("SELECT COUNT(*) AS count FROM tools")->fetch_assoc()['count'];
?>
