<?php
include "../DatabaseConnection.php"; 

$message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $location = trim($_POST['location']);
    $github = isset($_POST['github_link']) ? trim($_POST['github_link']) : null;
    $linkedin = isset($_POST['linkedin_link']) ? trim($_POST['linkedin_link']) : null;
    $facebook = isset($_POST['facebook_link']) ? trim($_POST['facebook_link']) : null;

    $stmt = $conn->prepare("INSERT INTO contact_info 
        (email, phone, location, github_link, linkedin_link, facebook_link) 
        VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $email, $phone, $location, $github, $linkedin, $facebook);

    if ($stmt->execute()) {
        $message = "✅ Contact information added successfully!";
        header("Location: ../../Pages/Contact.php?message=" . urlencode($message));
        exit; 
    } else {
        $message = "❌ Error: " . $stmt->error;
        echo $message;
    }

    $stmt->close();
    $conn->close();
}
?>
