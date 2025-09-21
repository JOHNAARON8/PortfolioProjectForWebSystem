<?php
include "../DatabaseConnection.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $category = $_POST['category'];
    $proficiency = $_POST['proficiency'];

    $iconPath = null;
    if (isset($_FILES['icon']) && $_FILES['icon']['error'] === 0) {
        $targetDir = "../../../uploads/tools/";

        // Create folder if it doesn't exist
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0777, true); 
        }

        $iconPath = $targetDir . basename($_FILES['icon']['name']);
        move_uploaded_file($_FILES['icon']['tmp_name'], $iconPath);

        // Optional: delete old icon
        $stmtOld = $conn->prepare("SELECT icon_path FROM tools WHERE id = ?");
        $stmtOld->bind_param("i", $id);
        $stmtOld->execute();
        $resultOld = $stmtOld->get_result();
        $oldTool = $resultOld->fetch_assoc();
        if ($oldTool && !empty($oldTool['icon_path']) && file_exists($oldTool['icon_path'])) {
            unlink($oldTool['icon_path']);
        }

        $stmt = $conn->prepare("UPDATE tools SET name = ?, category = ?, proficiency_percentage = ?, icon_path = ? WHERE id = ?");
        $stmt->bind_param("ssisi", $name, $category, $proficiency, $iconPath, $id);
    } else {
        $stmt = $conn->prepare("UPDATE tools SET name = ?, category = ?, proficiency_percentage = ? WHERE id = ?");
        $stmt->bind_param("ssii", $name, $category, $proficiency, $id);
    }

    if ($stmt->execute()) {
        header("Location: ../../Pages/Tools.php?message=Tool+updated+successfully");
        exit;
    } else {
        echo "Error updating tool: " . $stmt->error;
    }
} else {
    echo "Invalid request.";
}

?>
