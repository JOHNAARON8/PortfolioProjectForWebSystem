<?php
session_start();

include "../DatabaseConnection.php"; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $user_id = $_SESSION['user_id'];
    $cert_name = $_POST['cert_name'];
    $issuing_organization = $_POST['issuing_organization'];
    $issue_date = $_POST['issue_date'];
    $expiration_date = !empty($_POST['expiration_date']) ? $_POST['expiration_date'] : NULL;

    $certificate_file = NULL;
    if (!empty($_FILES['certificate_file']['name'])) {
        $fileName = time() . '_' . basename($_FILES['certificate_file']['name']);
        $targetDir = "../../../uploads/certificates/";
        if (!file_exists($targetDir)) mkdir($targetDir, 0777, true);
        $targetFilePath = $targetDir . $fileName;
        if (move_uploaded_file($_FILES['certificate_file']['tmp_name'], $targetFilePath)) {
            $certificate_file = "../../../uploads/certificates/" . $fileName;
        }
    }
    $stmt = $conn->prepare("INSERT INTO certifications (user_id, cert_name, issuing_organization, issue_date, expiration_date, certificate_file) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("isssss", $user_id, $cert_name, $issuing_organization, $issue_date, $expiration_date, $certificate_file);

    if ($stmt->execute()) {
        header("Location: ../../Pages/Certification.php?success=1");
        exit;
    } else {
        echo "Error: " . $conn->error;
    }
}
?>
