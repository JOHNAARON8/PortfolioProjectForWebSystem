<?php
include "../DatabaseConnection.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (!empty($_POST['id'])) {
        $id = intval($_POST['id']); // sanitize input

        // Delete experience (highlights will be deleted automatically due to ON DELETE CASCADE)
        $sql = "DELETE FROM experiences WHERE id = $id";

        if ($conn->query($sql)) {
            header("Location: ../../Pages/Experience.php?message=Experience+deleted+successfully");
            exit;
        } else {
            // Handle SQL error
            header("Location: ../../Pages/Experience.php?error=Failed+to+delete+experience");
            exit;
        }
    } else {
        header("Location: ../../Pages/Experience.php?error=Invalid+experience+ID");
        exit;
    }
} else {
    // Prevent GET requests
    header("Location: ../../Pages/Experience.php?error=Invalid+request");
    exit;
}
?>
