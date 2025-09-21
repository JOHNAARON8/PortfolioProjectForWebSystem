<?php
include "../DatabaseConnection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullName = trim($_POST['fullName'] ?? '');
    $bio = trim($_POST['bio'] ?? '');
    $cvLink = trim($_POST['cvLink'] ?? '');

    // Fetch current intro record
    $currentImage = null;
    $result = $conn->query("SELECT profile_image FROM introduction WHERE id = 1");
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $currentImage = $row['profile_image'];
    }

    $profileImagePath = $currentImage;
    if (isset($_FILES['profileImage']) && $_FILES['profileImage']['error'] == 0) {
        $uploadDir = "../../../uploads/intro/";
        if (!is_dir($uploadDir)) mkdir($uploadDir, 0777, true);

        $fileName = time() . "_" . basename($_FILES['profileImage']['name']);
        $profileImagePath = $uploadDir . $fileName;

        if (move_uploaded_file($_FILES['profileImage']['tmp_name'], $profileImagePath)) {
            // Delete old image
            if (!empty($currentImage) && file_exists($currentImage)) {
                unlink($currentImage);
            }
        }
    }

    $sql = "UPDATE introduction 
            SET full_name=?, bio=?, profile_image=?, cv_link=?, updated_at=NOW()
            WHERE id=1";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $fullName, $bio, $profileImagePath, $cvLink);

    if ($stmt->execute()) {
        header("Location: ../../Pages/Intro.php?messaege=updated");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>
