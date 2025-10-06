<?php
include './Backends/DatabaseConnection.php';

$tables = [
    'introduction', 
    'titles', 
    'about', 
    'skills', 
    'experiences', 
    'experience_highlights',
    'tools', 
    'education', 
    'projects', 
    'project_tools', 
    'contact_info',
    'certifications'
];

$latestUpdate = null;

foreach ($tables as $table) {
    $result = $conn->query("SHOW COLUMNS FROM $table LIKE 'updated_at'");
    if ($result && $result->num_rows > 0) {
        $res = $conn->query("SELECT MAX(updated_at) as last_update FROM $table");
        if ($res) {
            $row = $res->fetch_assoc();
            if ($row['last_update'] !== null) {
                if ($latestUpdate === null || strtotime($row['last_update']) > strtotime($latestUpdate)) {
                    $latestUpdate = $row['last_update'];
                }
            }
        }
    }
}

$latestUpdate = $latestUpdate ?? '';
?>
