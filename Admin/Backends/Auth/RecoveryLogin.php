<?php
session_start();
include "../DatabaseConnection.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $recoveryName = trim($_POST['recoveryName'] ?? '');

    if (empty($recoveryName)) {
        $_SESSION['error'] = "Please enter recovery name.";
        header("Location: ../../LoginForm.php");
        exit;
    }

    $sql = "SELECT * FROM Users WHERE recoveryName = ? LIMIT 1";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $recoveryName);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        $_SESSION['attempts'] = 0;
        $_SESSION['user_id'] = $row['id'];
        $_SESSION['username'] = $row['userName'];
        header("Location: ../../component/loader.php");
        exit;
    } else {
        $_SESSION['error'] = "Recovery name not found.";
        header("Location: ../../LoginForm.php");
        exit;
    }
}
?>
