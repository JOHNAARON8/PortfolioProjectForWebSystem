<?php
include "../Backends/DatabaseConnection.php";

$projectsResult = $conn->query("SELECT * FROM projects ORDER BY created_at DESC");
$projects = $projectsResult->fetch_all(MYSQLI_ASSOC);

$projectTools = [];
foreach ($projects as $proj) {
    $projId = $proj['id'];
    $toolsResult = $conn->query("SELECT * FROM project_tools WHERE project_id = $projId");
    $projectTools[$projId] = $toolsResult->fetch_all(MYSQLI_ASSOC);
}
?>
