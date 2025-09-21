<?php
include "../DatabaseConnection.php";

$id = $_GET['id'] ?? null;

if ($id) {
    $stmt = $conn->prepare("DELETE FROM skills WHERE id=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
}

header("Location: ../../Pages/About.php?message=Skill+deleted+successfully");
exit;
