<?php
include "../Backends/DatabaseConnection.php";

$toolsResult = $conn->query("SELECT * FROM tools ORDER BY category, name ASC");
$tools = $toolsResult->fetch_all(MYSQLI_ASSOC);
?>