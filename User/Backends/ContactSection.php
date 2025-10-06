<?php
include "./Backends/DatabaseConnection.php";

$contact = null;
$contactQuery = $conn->query("SELECT * FROM contact_info ORDER BY id DESC LIMIT 1");
if ($contactQuery && $contactQuery->num_rows > 0) {
    $contact = $contactQuery->fetch_assoc();
}
?>
