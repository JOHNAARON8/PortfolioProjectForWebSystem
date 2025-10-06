<?php
include "./Backends/DatabaseConnection.php";

$projects = [];
$projectQuery = $conn->query("SELECT * FROM projects ORDER BY created_at DESC");
if ($projectQuery) {
    while ($row = $projectQuery->fetch_assoc()) {
        $projectId = $row['id'];
        $toolsQuery = $conn->query("SELECT tool_name FROM project_tools WHERE project_id = $projectId");
        $tools = [];
        if ($toolsQuery) {
            while ($tool = $toolsQuery->fetch_assoc()) {
                $tools[] = $tool['tool_name'];
            }
        }
        $row['tools'] = $tools;
        $projects[] = $row;
    }
}
?>