<?php
include "../DatabaseConnection.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $year_label = $conn->real_escape_string($_POST['year_label']);
    $category = $conn->real_escape_string($_POST['category']);
    $title = $conn->real_escape_string($_POST['title']);
    $organization = $conn->real_escape_string($_POST['organization']);
    $badge = $conn->real_escape_string($_POST['badge']);
    $highlights = $_POST['highlights'];

    $sql = "INSERT INTO experiences (year_label, category, title, organization, badge) 
            VALUES ('$year_label', '$category', '$title', '$organization', '$badge')";
    if ($conn->query($sql)) {
        $experience_id = $conn->insert_id;

        foreach ($highlights as $h) {
            if (!empty(trim($h))) {
                $h_clean = $conn->real_escape_string($h);
                $conn->query("INSERT INTO experience_highlights (experience_id, highlight) 
                              VALUES ($experience_id, '$h_clean')");
            }
        }
    }
}

header("Location: ../../Pages/Experience.php?message=Experience+added+successfully");
exit;
?>
