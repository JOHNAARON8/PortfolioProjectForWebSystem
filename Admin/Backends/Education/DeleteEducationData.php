<?php
include "../DatabaseConnection.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['id']) && !empty($_POST['id'])) {
        $id = intval($_POST['id']);

        $result = $conn->query("SELECT image_path FROM education WHERE id = $id");
        if ($result && $row = $result->fetch_assoc()) {
            $imagePath = $row['image_path'];
            if (!empty($imagePath) && file_exists($imagePath)) {
                unlink($imagePath); // Delete the image file
            }
        }

        // Delete the record from database
        $deleteQuery = "DELETE FROM education WHERE id = $id";
        if ($conn->query($deleteQuery)) {
            header("Location: ../../Pages/Education.php?message=Education+record+deleted+successfully");
            exit();
        } else {
            echo "Error deleting record: " . $conn->error;
        }
    } else {
        echo "Invalid ID.";
    }
} else {
    echo "Invalid request method.";
}
?>
