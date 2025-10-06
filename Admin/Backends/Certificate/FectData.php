<?php
session_start();
include "../Backends/DatabaseConnection.php";

$user_id = $_SESSION['user_id'];

$sql = "SELECT * FROM certifications WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$certifications = $result->fetch_all(MYSQLI_ASSOC);
?>
