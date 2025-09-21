<?php
include "../DatabaseConnection.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $id = $_POST['id'];

    $stmtSelect = $conn->prepare("SELECT icon_path FROM tools WHERE id = ?");
    $stmtSelect->bind_param("i", $id);
    $stmtSelect->execute();
    $result = $stmtSelect->get_result();
    $tool = $result->fetch_assoc();
    
    if ($tool && !empty($tool['icon_path']) && file_exists($tool['icon_path'])) {
        unlink($tool['icon_path']); 
    }

    $stmt = $conn->prepare("DELETE FROM tools WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        header("Location: ../../Pages/Tools.php?message=Tool+deleted+successfully");
        exit;
    } else {
        echo "Error deleting tool: " . $stmt->error;
    }
} else {
    echo "Invalid request.";
}
?>
