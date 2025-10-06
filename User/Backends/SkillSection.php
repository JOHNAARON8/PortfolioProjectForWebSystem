<?php
include "./Backends/DatabaseConnection.php";

$sql = "SELECT * FROM tools ORDER BY FIELD(category, 'Frontend','Backend','Databases','Tools & Others'), name";
$result = $conn->query($sql);

$skills = [];
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $skills[$row['category']][] = $row;
    }
}
?>
