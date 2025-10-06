<?php
include "../DatabaseConnection.php";

$selfIntro = $_POST['selfIntroduction'] ?? '';
$years = $_POST['years_experience'] ?? 0;

$check = $conn->query("SELECT id FROM about LIMIT 1");

if ($check->num_rows > 0) {
    $about = $check->fetch_assoc();
    $stmt = $conn->prepare("UPDATE about SET selfIntroduction=?, years_experience=? WHERE id=?");
    $stmt->bind_param("sii", $selfIntro, $years, $about['id']);
    $stmt->execute();
} else {
    $stmt = $conn->prepare("INSERT INTO about (selfIntroduction, years_experience) VALUES (?, ?)");
    $stmt->bind_param("si", $selfIntro, $years);
    $stmt->execute();
}

header("Location: ../../Pages/About.php?message=About+section+updated+successfully");
exit;
