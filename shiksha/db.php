<?php
$host = "localhost";
$user = "root";      // XAMPP default user
$pass = "";          // XAMPP default password is empty
$dbname = "portal_db"; // Change if your DB name is different

$conn = new mysqli($host, $user, $pass, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
