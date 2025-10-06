<?php
include "../DatabaseConnection.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $title = $conn->real_escape_string($_POST['title']);
    $short_description = $conn->real_escape_string($_POST['short_description']);
    $full_description = $conn->real_escape_string($_POST['full_description']);
    $live_link = $conn->real_escape_string($_POST['live_link']);
    $tools = isset($_POST['tools']) ? $_POST['tools'] : '';

    $coverImagePath = null;
    if (isset($_FILES['cover_image']) && $_FILES['cover_image']['error'] === 0) {
        $targetDir = "../../../uploads/projects/";

        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0755, true);
        }

        $fileName = time() . '_' . basename($_FILES['cover_image']['name']);
        $targetFile = $targetDir . $fileName;

        if (move_uploaded_file($_FILES['cover_image']['tmp_name'], $targetFile)) {
            $coverImagePath = $targetFile;
        } else {
            echo "Error uploading cover image.";
            exit();
        }
    }

    $stmt = $conn->prepare("INSERT INTO projects (title, short_description, full_description, cover_image, live_link) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $title, $short_description, $full_description, $coverImagePath, $live_link);

    if ($stmt->execute()) {
        $projectId = $stmt->insert_id;

        if (!empty($tools)) {
            $toolArray = array_map('trim', explode(',', $tools)); // split comma-separated
            $toolStmt = $conn->prepare("INSERT INTO project_tools (project_id, tool_name) VALUES (?, ?)");
            foreach ($toolArray as $tool) {
                if (!empty($tool)) {
                    $toolStmt->bind_param("is", $projectId, $tool);
                    $toolStmt->execute();
                }
            }
            $toolStmt->close();
        }

        header("Location: ../../Pages/Project.php?message=Project created successfully");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "Invalid request method.";
}
?>
