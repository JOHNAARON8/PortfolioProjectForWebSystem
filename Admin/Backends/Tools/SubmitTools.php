<?php
include "../DatabaseConnection.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $category = $_POST['category'];
    $proficiency = $_POST['proficiency'];

    $iconPath = null;
    if (isset($_FILES['icon']) && $_FILES['icon']['error'] === 0) {
        $targetDir = "../../../uploads/tools/";

        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0755, true); 
        }

        $iconPath = $targetDir . basename($_FILES['icon']['name']);
        if (!move_uploaded_file($_FILES['icon']['tmp_name'], $iconPath)) {
            die("Failed to upload the image.");
        }
    }

    $stmt = $conn->prepare("INSERT INTO tools (name, category, icon_path, proficiency_percentage) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("sssi", $name, $category, $iconPath, $proficiency);

    if ($stmt->execute()) {
        header("Location: ../../Pages/Tools.php?success=1");
        exit;
    } else {
        echo "Error: " . $stmt->error;
    }
} else {
    echo "Invalid request method.";
}
?>
