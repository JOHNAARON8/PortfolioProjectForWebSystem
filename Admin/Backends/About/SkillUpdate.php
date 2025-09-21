<?php
include "../DatabaseConnection.php";

$id = $_POST['id'] ?? null;
$skill = $_POST['skill'] ?? '';
$desc = $_POST['skillDescription'] ?? '';

if ($id && $skill && $desc) {
    $stmt = $conn->prepare("UPDATE skills SET skill=?, skillDescription=? WHERE id=?");
    $stmt->bind_param("ssi", $skill, $desc, $id);
    $stmt->execute();
}

header("Location: ../../Pages/About.php?message=Skill+updated+successfully");
exit;
