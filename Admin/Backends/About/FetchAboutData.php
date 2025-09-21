<?php
include "../Backends/DatabaseConnection.php";

// Fetch about info (only one row expected)
$about = $conn->query("SELECT * FROM about LIMIT 1")->fetch_assoc();

// Fetch skills linked to about
$skills = [];
if ($about) {
    $skills = $conn->query("SELECT * FROM skills WHERE about_id={$about['id']}")->fetch_all(MYSQLI_ASSOC);
}
?>