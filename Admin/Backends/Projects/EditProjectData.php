<?php
include "../DatabaseConnection.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $id = intval($_POST['id']);
    $title = $conn->real_escape_string($_POST['title']);
    $short_description = $conn->real_escape_string($_POST['short_description']);
    $full_description = $conn->real_escape_string($_POST['full_description']);
    $live_link = $conn->real_escape_string($_POST['live_link']);
    $tools = isset($_POST['tools']) ? $_POST['tools'] : '';

    // Handle image upload
    $imagePath = null;
    if (isset($_FILES['cover_image']) && $_FILES['cover_image']['error'] === 0) {
        $targetDir = "../../../uploads/projects/";
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0755, true);
        }

        $fileName = time() . '_' . basename($_FILES['cover_image']['name']);
        $targetFile = $targetDir . $fileName;

        if (move_uploaded_file($_FILES['cover_image']['tmp_name'], $targetFile)) {
            $imagePath = $targetFile;

            // Optionally, delete old image
            $oldImage = $conn->query("SELECT cover_image FROM projects WHERE id = $id")->fetch_assoc();
            if (!empty($oldImage['cover_image']) && file_exists($oldImage['cover_image'])) {
                unlink($oldImage['cover_image']);
            }
        } else {
            echo "Error uploading image.";
            exit();
        }
    }

    // Update project data
    if ($imagePath) {
        $stmt = $conn->prepare("UPDATE projects SET title=?, short_description=?, full_description=?, live_link=?, cover_image=? WHERE id=?");
        $stmt->bind_param("sssssi", $title, $short_description, $full_description, $live_link, $imagePath, $id);
    } else {
        $stmt = $conn->prepare("UPDATE projects SET title=?, short_description=?, full_description=?, live_link=? WHERE id=?");
        $stmt->bind_param("ssssi", $title, $short_description, $full_description, $live_link, $id);
    }

    if ($stmt->execute()) {
        // Update tools
        $conn->query("DELETE FROM project_tools WHERE project_id = $id"); // Remove old tools
        if (!empty($tools)) {
            $toolArray = explode(",", $tools);
            $stmtTools = $conn->prepare("INSERT INTO project_tools (project_id, tool_name) VALUES (?, ?)");
            foreach ($toolArray as $tool) {
                $toolName = trim($tool);
                if ($toolName !== '') {
                    $stmtTools->bind_param("is", $id, $toolName);
                    $stmtTools->execute();
                }
            }
        }

        header("Location: ../../Pages/Project.php?message=Project updated successfully");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();

} else {
    echo "Invalid request method.";
}
?>
