<?php 
include "../Backends/DatabaseConnection.php"; 

$userId = $_SESSION['user_id'] ?? null;

if (!$userId) {
    header("Location: ../LoginForm.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userName = trim($_POST['userName']);
    $password = trim($_POST['password']);
    $recoveryName = trim($_POST['recoveryName']);

    $hashedPassword = !empty($password) ? password_hash($password, PASSWORD_BCRYPT) : null;

    if ($hashedPassword) {
        $sql = "UPDATE Users SET userName = ?, password = ?, recoveryName = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssi", $userName, $hashedPassword, $recoveryName, $userId);
    } else {
        $sql = "UPDATE Users SET userName = ?, recoveryName = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssi", $userName, $recoveryName, $userId);
    }

    if ($stmt->execute()) {
        $_SESSION['flash_message'] = "Updated successfully!";
        $_SESSION['flash_type'] = "success";
    } else {
        $_SESSION['flash_message'] = "❌ Failed to update account.";
        $_SESSION['flash_type'] = "error";
    }

    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}

$sql = "SELECT userName, recoveryName FROM Users WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $userId);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
?>
