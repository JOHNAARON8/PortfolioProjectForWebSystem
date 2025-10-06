<?php
session_start();
include "../DatabaseConnection.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = trim($_POST['username'] ?? '');
    $password = trim($_POST['password'] ?? '');

    if (empty($username) || empty($password)) {
        $_SESSION['error'] = "Please enter both fields.";
        header("Location: ../../LoginForm.php");
        exit;
    }

    $sql = "SELECT * FROM Users WHERE (userName = ? OR recoveryName = ?) LIMIT 1";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $username, $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        $dbPassword = $row['password'];

        if (password_verify($password, $dbPassword) || $password === $dbPassword) {

            $_SESSION['attempts'] = 0;
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['username'] = $row['userName'];
            header("Location: ../../component/loader.php");
            exit;
        } else {
            $_SESSION['attempts'] = ($_SESSION['attempts'] ?? 0) + 1;
            $_SESSION['error'] = "Invalid password.";
        }
    } else {
        $_SESSION['attempts'] = ($_SESSION['attempts'] ?? 0) + 1;
        $_SESSION['error'] = "No account found.";
    }

    header("Location: ../../LoginForm.php");
    exit;
}
?>
