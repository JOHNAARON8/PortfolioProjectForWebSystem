<?php
include './Backends/DatabaseConnection.php';

$certifications = [];

try {

    $stmt = $conn->prepare("SELECT * FROM certifications ORDER BY issue_date DESC");
    $stmt->execute();

    $result = $stmt->get_result();
    $certifications = $result->fetch_all(MYSQLI_ASSOC);

    foreach ($certifications as &$cert) {
        $cert['issue_date'] = date('Y-m-d', strtotime($cert['issue_date']));
        if (!empty($cert['expiration_date'])) {
            $cert['expiration_date'] = date('Y-m-d', strtotime($cert['expiration_date']));
        }
    }

    $certifications = array_map("unserialize", array_unique(array_map("serialize", $certifications)));

} catch (Exception $e) {
    error_log("Error fetching certifications: " . $e->getMessage());
}
?>
