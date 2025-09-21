<?php
include "../Backends/DatabaseConnection.php";

$experiencesSql = "SELECT * FROM experiences ORDER BY id DESC";
$experiencesResult = $conn->query($experiencesSql);
$experiences = $experiencesResult->fetch_all(MYSQLI_ASSOC);

$highlights = [];
foreach ($experiences as $exp) {
    $expId = $exp['id'];
    $highlightSql = "SELECT * FROM experience_highlights WHERE experience_id = $expId";
    $highlightResult = $conn->query($highlightSql);
    $highlights[$expId] = $highlightResult->fetch_all(MYSQLI_ASSOC);
}
?>