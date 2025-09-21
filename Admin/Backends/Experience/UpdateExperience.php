<?php
include "../DatabaseConnection.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // 1️⃣ Get main experience fields
    $id = intval($_POST['id']);
    $year_label = $conn->real_escape_string($_POST['year_label']);
    $category = $conn->real_escape_string($_POST['category']);
    $title = $conn->real_escape_string($_POST['title']);
    $organization = $conn->real_escape_string($_POST['organization']);
    $badge = $conn->real_escape_string($_POST['badge']);

    // 2️⃣ Start transaction (to ensure both tables are updated safely)
    $conn->begin_transaction();

    try {
        // Update experiences table
        $updateExpSql = "
            UPDATE experiences
            SET year_label = '$year_label',
                category = '$category',
                title = '$title',
                organization = '$organization',
                badge = '$badge',
                updated_at = NOW()
            WHERE id = $id
        ";
        $conn->query($updateExpSql);

        // 3️⃣ Update highlights
        // For simplicity, delete existing highlights first
        $conn->query("DELETE FROM experience_highlights WHERE experience_id = $id");

        if (isset($_POST['highlights']) && is_array($_POST['highlights'])) {
            $stmt = $conn->prepare("INSERT INTO experience_highlights (experience_id, highlight) VALUES (?, ?)");
            foreach ($_POST['highlights'] as $highlight) {
                $trimmed = trim($highlight);
                if ($trimmed !== '') {
                    $stmt->bind_param("is", $id, $trimmed);
                    $stmt->execute();
                }
            }
            $stmt->close();
        }

        // 4️⃣ Commit transaction
        $conn->commit();

        // Redirect back with success
        header("Location: ../../Pages/Experience.php?message=Experience+updated+successfully");
        exit;

    } catch (Exception $e) {
        $conn->rollback();
        die("Error updating experience: " . $e->getMessage());
    }

} else {
    die("Invalid request method.");
}
?>
