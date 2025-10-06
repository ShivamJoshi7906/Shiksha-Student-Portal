<?php
// --- PHP LOGIC: DATABASE CONNECTION AND DATA DELETION ---

// Set up database connection
$conn = new mysqli("localhost", "root", "", "student_portal");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if an ID was passed via the URL
if (isset($_GET['id'])) {
    // Sanitize and cast the ID to an integer for security
    $id = (int)$_GET['id'];

    // 1. Prepare the SQL DELETE statement (Secure Method)
    $stmt = $conn->prepare("DELETE FROM events WHERE id = ?");

    // 2. Bind the ID parameter (i = integer)
    $stmt->bind_param("i", $id);

    // 3. Execute the statement
    if ($stmt->execute()) {
        // Success: Redirect to the event list
        echo "<script>alert('Event deleted successfully.');window.location='events_read.php';</script>";
    } else {
        // Failure: Show the specific SQL error
        echo "<script>alert('Error deleting event: " . $stmt->error . "');window.location='events_read.php';</script>";
    }
    
    // Close statement
    $stmt->close();

} else {
    // If no ID was provided
    echo "<script>alert('Error: No Event ID specified for deletion.');window.location='events_read.php';</script>";
}

// Close connection
$conn->close();
?>