<?php
include "../DatabaseConnection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titleId = intval($_POST['title_id'] ?? 0);
    $newTitle = trim($_POST['title'] ?? '');

    if ($titleId > 0 && !empty($newTitle)) {
        $sql = "UPDATE titles SET title = ?, created_at = NOW() WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("si", $newTitle, $titleId);

        if ($stmt->execute()) {
            header("Location: ../../Pages/Intro.php?update=success");
            exit();
        } else {
            echo "Error updating title: " . $stmt->error;
        }
    } else {
        echo "Invalid title or ID.";
    }
}
?>
