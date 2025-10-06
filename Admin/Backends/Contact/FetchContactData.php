<?php
include "../Backends/DatabaseConnection.php";

$contactResult = $conn->query("SELECT * FROM contact_info LIMIT 1");
$contact = $contactResult->fetch_assoc();
?>
