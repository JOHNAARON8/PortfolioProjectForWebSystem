<?php
include "../DatabaseConnection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullName = trim($_POST['fullName'] ?? '');
    $bio = trim($_POST['bio'] ?? '');
    $cvLink = trim($_POST['cvLink'] ?? '');

    $profileImagePath = null;
    if (isset($_FILES['profileImage']) && $_FILES['profileImage']['error'] == 0) {
        $uploadDir = "../../../uploads/intro/";
        if (!is_dir($uploadDir)) mkdir($uploadDir, 0777, true);

        $fileName = time() . "_" . basename($_FILES['profileImage']['name']);
        $profileImagePath = $uploadDir . $fileName;

        move_uploaded_file($_FILES['profileImage']['tmp_name'], $profileImagePath);
    }

    $sql = "INSERT INTO introduction (full_name, bio, profile_image, cv_link, created_at) 
            VALUES (?, ?, ?, ?, NOW())";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $fullName, $bio, $profileImagePath, $cvLink);

    if ($stmt->execute()) {
        header("Location:  ../../Pages/Intro.php?success=1");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>
