<?php
include "../DatabaseConnection.php"; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $level = $conn->real_escape_string($_POST['level']);
    $school_name = $conn->real_escape_string($_POST['school_name']);
    $start_year = intval($_POST['start_year']);
    $end_year = intval($_POST['end_year']);
    $description = $conn->real_escape_string($_POST['description']);

    $imagePath = null;
    if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
        $targetDir = "../../../uploads/education/"; 

        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0755, true);
        }

        $fileName = time() . '_' . basename($_FILES['image']['name']);
        $targetFile = $targetDir . $fileName;

        if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
            $imagePath = $targetFile;
        } else {
            echo "Error uploading image.";
            exit();
        }
    }

    $stmt = $conn->prepare("INSERT INTO education (level, school_name, start_year, end_year, description, image_path) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssiiss", $level, $school_name, $start_year, $end_year, $description, $imagePath);
    

    if ($stmt->execute()) {
        header("Location: ../../Pages/Education.php?message=Education+record+created+successfully");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "Invalid request method.";
}
?>
