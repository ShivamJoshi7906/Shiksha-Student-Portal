<?php
// --- PHP LOGIC: DATABASE CONNECTION AND DATA DELETION ---
session_start();

$conn = new mysqli("localhost", "root", "", "student_portal");
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

// Add admin check here (similar to dashboard)

if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];

    // Use prepared statement for secure DELETE operation
    $stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo "<script>alert('User deleted successfully.');window.location='admin_dashboard.php';</script>";
    } else {
        echo "<script>alert('Error deleting user: " . $stmt->error . "');window.location='admin_dashboard.php';</script>";
    }
    
    $stmt->close();

} else {
    echo "<script>alert('Error: No User ID specified for deletion.');window.location='admin_dashboard.php';</script>";
}

$conn->close();
?>