<?php
include "./Backends/DatabaseConnection.php";

$sql = "SELECT * FROM experiences ORDER BY id ASC";
$result = $conn->query($sql);

$experiences = [];
if ($result && $result->num_rows > 0) {
    while ($exp = $result->fetch_assoc()) {
        $expId = $exp['id'];
        $highlightSql = "SELECT highlight FROM experience_highlights WHERE experience_id = $expId";
        $highlightRes = $conn->query($highlightSql);

        $exp['highlights'] = [];
        if ($highlightRes && $highlightRes->num_rows > 0) {
            while ($h = $highlightRes->fetch_assoc()) {
                $exp['highlights'][] = $h['highlight'];
            }
        }
        $experiences[] = $exp;
    }
}
?>
