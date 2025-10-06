<?php
include "../DatabaseConnection.php";

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['id'])) {
    $id = intval($_POST['id']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $location = trim($_POST['location']);
    $github = isset($_POST['github_link']) ? trim($_POST['github_link']) : null;
    $linkedin = isset($_POST['linkedin_link']) ? trim($_POST['linkedin_link']) : null;
    $facebook = isset($_POST['facebook_link']) ? trim($_POST['facebook_link']) : null;

    $stmt = $conn->prepare("UPDATE contact_info 
        SET email = ?, phone = ?, location = ?, github_link = ?, linkedin_link = ?, facebook_link = ?
        WHERE id = ?");
    $stmt->bind_param("ssssssi", $email, $phone, $location, $github, $linkedin, $facebook, $id);

    if ($stmt->execute()) {
        header("Location: ../../Pages/Contact.php?message=success");
        exit; 
    } else {
        echo "❌ Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
} else {
    echo "❌ Invalid request.";
}
?>
