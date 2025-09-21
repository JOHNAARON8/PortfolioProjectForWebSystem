<?php
include "../Backends/DatabaseConnection.php";

// Fetch introduction
$sql = "SELECT * FROM introduction WHERE id = 1 LIMIT 1";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $intro = $result->fetch_assoc();
    $formAction = "../Backends/Intro/UpdateIntroData.php";
} else {
    $intro = null; // no record exists
    $formAction = "../Backends/Intro/CreateIntroData.php";
}

// Fetch professional titles
$titlesSql = "SELECT * FROM titles WHERE introduction_id = 1";
$titlesResult = $conn->query($titlesSql);
$titles = $titlesResult->fetch_all(MYSQLI_ASSOC);

?>
