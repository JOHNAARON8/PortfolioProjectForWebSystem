<?php
include "../DatabaseConnection.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $projectId = intval($_POST['id']);

    $coverImageQuery = $conn->prepare("SELECT cover_image FROM projects WHERE id = ?");
    $coverImageQuery->bind_param("i", $projectId);
    $coverImageQuery->execute();
    $coverImageResult = $coverImageQuery->get_result()->fetch_assoc();
    $coverImagePath = $coverImageResult['cover_image'] ?? null;
    $coverImageQuery->close();

    $stmt = $conn->prepare("DELETE FROM projects WHERE id = ?");
    $stmt->bind_param("i", $projectId);

    if ($stmt->execute()) {

        if (!empty($coverImagePath) && file_exists($coverImagePath)) {
            unlink($coverImagePath);
        }

        header("Location: ../../Pages/Project.php?message=Project deleted successfully");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "Invalid request method.";
}
?>
