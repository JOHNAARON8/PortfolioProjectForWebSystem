<?php 
include "../Backends/DatabaseConnection.php";

$educationResult = $conn->query("SELECT * FROM education ORDER BY start_year DESC");
$educations = $educationResult->fetch_all(MYSQLI_ASSOC);
?>