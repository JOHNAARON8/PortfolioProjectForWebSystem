<?php
include "../DatabaseConnection.php";

$aboutId = $_POST['about_id'] ?? null;
$skill = $_POST['skill'] ?? '';
$desc = $_POST['skillDescription'] ?? '';

if ($aboutId && $skill && $desc) {
    $stmt = $conn->prepare("INSERT INTO skills (about_id, skill, skillDescription) VALUES (?, ?, ?)");
    $stmt->bind_param("iss", $aboutId, $skill, $desc);
    $stmt->execute();
}

header("Location: ../../Pages/About.php?message=Skill+added+successfully");
exit;
