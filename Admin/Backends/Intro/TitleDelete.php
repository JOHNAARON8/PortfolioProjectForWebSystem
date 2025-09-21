<?php
include "../DatabaseConnection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titleId = intval($_POST['title_id'] ?? 0);

    if ($titleId > 0) {
        $sql = "DELETE FROM titles WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $titleId);

        if ($stmt->execute()) {
            header("Location: ../../Pages/Intro.php?message=Title+deleted+successfully");
            exit();
        } else {
            echo "Error deleting title: " . $stmt->error;
        }
    } else {
        echo "Invalid ID.";
    }
}
?>
