<?php
include "../Backends/DatabaseConnection.php";

$projectsPerDay = [];
$dates = [];

for ($i = 6; $i >= 0; $i--) {
    $date = date('Y-m-d', strtotime("-$i days"));
    $dates[] = $date;

    $query = $conn->prepare("SELECT COUNT(*) as count FROM projects WHERE DATE(created_at) = ?");
    $query->bind_param("s", $date);
    $query->execute();
    $result = $query->get_result()->fetch_assoc();
    $projectsPerDay[] = $result['count'] ?? 0;
}
?>
