<?php
session_start();
$conn = new mysqli("localhost", "root", "", "portal_db");
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

$username = trim($_POST['username']);
$password = $_POST['password'];

$stmt = $conn->prepare("SELECT password FROM users WHERE username=?");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();
    $dbPassword = $row['password'];
    if (password_verify($password, $dbPassword)) {
        $_SESSION['username'] = $username;
        header("Location: dashboard.php");
        exit();
    } else {
        echo "<script>alert('Incorrect password!'); window.location.href='login.php';</script>";
    }
} else {
    echo "<script>alert('Username not found! Please register.'); window.location.href='USER-REGISTRATION.php';</script>";
}
$stmt->close();
$conn->close();
?>
