<?php
$host = 'localhost';
$username = 'root';
$password = ''; 
$database = 'PortfolioDatabase'; 

$conn = new mysqli($host, $username, $password, $database);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    echo "Connected successfully to the database.";
}


?>
