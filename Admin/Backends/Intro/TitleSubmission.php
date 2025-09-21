<?php
include "../DatabaseConnection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = trim($_POST['title'] ?? '');

    if (!empty($title)) {
        $sql = "INSERT INTO titles (introduction_id, title) VALUES (1, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $title);

        if ($stmt->execute()) {
            header("Location: ../../Pages/Intro.php?message=Title+added+successfully");
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }
    } else {
        echo "Title cannot be empty.";
    }
}
?>
