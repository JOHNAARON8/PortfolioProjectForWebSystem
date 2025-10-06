<?php
session_start();
include "../DatabaseConnection.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $id = $_POST['id'];
    $user_id = $_SESSION['user_id'];

    $stmtSelect = $conn->prepare("SELECT certificate_file FROM certifications WHERE id = ? AND user_id = ?");
    $stmtSelect->bind_param("ii", $id, $user_id);
    $stmtSelect->execute();
    $result = $stmtSelect->get_result();
    $cert = $result->fetch_assoc();

    if ($cert && !empty($cert['certificate_file']) && file_exists($cert['certificate_file'])) {
        unlink($cert['certificate_file']); // Delete the file
    }

    $stmt = $conn->prepare("DELETE FROM certifications WHERE id = ? AND user_id = ?");
    $stmt->bind_param("ii", $id, $user_id);

    if ($stmt->execute()) {
        header("Location: ../../Pages/Certification.php?message=Certificate+deleted+successfully");
        exit;
    } else {
        echo "Error deleting certificate: " . $stmt->error;
    }
} else {
    echo "Invalid request.";
}
?>
