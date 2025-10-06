<?php
include "./Backends/DatabaseConnection.php";

$sql = "SELECT * FROM education ORDER BY start_year ASC";
$result = $conn->query($sql);

$education = [];
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $education[] = $row;
    }
}
?>
