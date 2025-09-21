<?php
include "../DatabaseConnection.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $id = intval($_POST['id']);
    $level = $conn->real_escape_string($_POST['level']);
    $school_name = $conn->real_escape_string($_POST['school_name']);
    $start_year = intval($_POST['start_year']);
    $end_year = intval($_POST['end_year']);
    $description = $conn->real_escape_string($_POST['description']);


    $stmtSelect = $conn->prepare("SELECT image_path FROM education WHERE id = ?");
    $stmtSelect->bind_param("i", $id);
    $stmtSelect->execute();
    $result = $stmtSelect->get_result();
    $education = $result->fetch_assoc();
    $stmtSelect->close();

    $imagePath = $education['image_path']; 

    // Handle new image upload
    if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
        $targetDir = "../../../uploads/education/";

        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0755, true);
        }

        $fileName = time() . '_' . basename($_FILES['image']['name']);
        $targetFile = $targetDir . $fileName;

        if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
            // Delete old image if it exists
            if (!empty($imagePath) && file_exists($imagePath)) {
                unlink($imagePath);
            }
            $imagePath = $targetFile;
        } else {
            echo "Error uploading image.";
            exit();
        }
    }

    // Update database record
    $stmtUpdate = $conn->prepare("UPDATE education SET level = ?, school_name = ?, start_year = ?, end_year = ?, description = ?, image_path = ? WHERE id = ?");
    $stmtUpdate->bind_param("ssiissi", $level, $school_name, $start_year, $end_year, $description, $imagePath, $id);

    if ($stmtUpdate->execute()) {
        header("Location: ../../Pages/Education.php?message=Education+updated+successfully");
        exit();
    } else {
        echo "Error: " . $stmtUpdate->error;
    }

    $stmtUpdate->close();
} else {
    echo "Invalid request method.";
}
?>
