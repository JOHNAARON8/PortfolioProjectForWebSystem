<?php
include "../Backends/DatabaseConnection.php";

$about = $conn->query("SELECT * FROM about LIMIT 1")->fetch_assoc();

$skills = [];
if ($about) {
    $skills = $conn->query("SELECT * FROM skills WHERE about_id={$about['id']}")->fetch_all(MYSQLI_ASSOC);
}
?>