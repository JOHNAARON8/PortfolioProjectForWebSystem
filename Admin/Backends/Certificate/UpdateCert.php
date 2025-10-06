<?php
session_start();
include "../DatabaseConnection.php";
echo "Session ID: " . $_SESSION['user_id'];
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {

    $cert_id = $_POST['id'];
    $user_id = $_SESSION['user_id'];

    $cert_name = $_POST['cert_name'];
    $issuing_organization = $_POST['issuing_organization'];
    $issue_date = $_POST['issue_date'];
    $expiration_date = !empty($_POST['expiration_date']) ? $_POST['expiration_date'] : NULL;

    $stmtSelect = $conn->prepare("SELECT certificate_file FROM certifications WHERE id = ? AND user_id = ?");
    $stmtSelect->bind_param("ii", $cert_id, $user_id);
    $stmtSelect->execute();
    $result = $stmtSelect->get_result();
    $cert = $result->fetch_assoc();

    if (!$cert) {
        die("Certificate not found or you don't have permission to edit it.");
    }

    $certificate_file = $cert['certificate_file']; 

    if (!empty($_FILES['certificate_file']['name'])) {
        $fileName = time() . '_' . basename($_FILES['certificate_file']['name']);
        $targetDir = "../../../uploads/certificates/";
        if (!file_exists($targetDir)) mkdir($targetDir, 0777, true);
        $targetFilePath = $targetDir . $fileName;

        if (move_uploaded_file($_FILES['certificate_file']['tmp_name'], $targetFilePath)) {

            if (!empty($certificate_file) && file_exists($certificate_file)) {
                unlink($certificate_file);
            }
            $certificate_file = $targetFilePath; 
        }
    }

    $stmtUpdate = $conn->prepare("UPDATE certifications SET cert_name = ?, issuing_organization = ?, issue_date = ?, expiration_date = ?, certificate_file = ? WHERE id = ? AND user_id = ?");
    $stmtUpdate->bind_param("sssssii", $cert_name, $issuing_organization, $issue_date, $expiration_date, $certificate_file, $cert_id, $user_id);

    if ($stmtUpdate->execute()) {
        header("Location: ../../Pages/Certification.php?message=Certificate+updated+successfully");
        exit;
    } else {
        echo "Error updating certificate: " . $conn->error;
    }

} else {
    echo "Invalid request.";
}
?>
