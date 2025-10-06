<?php
session_start();

// Database connection details
$servername = "localhost";
$username_db = "root";
$password_db = "";
$dbname = "student_portal"; // Corrected database name based on previous contexts (portal_db to student_portal)

// 1. Database Connection
$conn = new mysqli($servername, $username_db, $password_db, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form data was received
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: USER-REGISTRATION.php");
    exit();
}

// --- 2. INPUT SANITIZATION and RETRIEVAL ---
// Use filter_input for retrieval and sanitization
$username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_SPECIAL_CHARS);
$password = $_POST['password'];
$confirmPassword = $_POST['confirmPassword'];

// --- 3. DATA VALIDATION ---
$errors = [];

// Validation 1: Check for empty fields
if (empty($username) || empty($password) || empty($confirmPassword)) {
    $errors[] = "All fields are required.";
}

// Validation 2: Check username length/format
if (strlen($username) < 3 || !preg_match('/^[a-zA-Z0-9_]+$/', $username)) {
    $errors[] = "Username must be at least 3 characters and contain only letters, numbers, or underscores.";
}

// Validation 3: Check password strength (min 8 chars)
if (strlen($password) < 8) {
    $errors[] = "Password must be at least 8 characters long.";
}

// Validation 4: Password match check
if ($password !== $confirmPassword) {
    $errors[] = "Passwords do not match!";
}

// If any initial validation fails, display errors and exit
if (!empty($errors)) {
    $error_message = implode("\n", $errors);
    echo "<script>alert('Registration Failed:\\n" . $error_message . "'); window.location.href='USER-REGISTRATION.php';</script>";
    exit();
}

// --- 4. CHECK IF USERNAME EXISTS (The existing database check) ---
$stmt = $conn->prepare("SELECT id FROM users WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    echo "<script>alert('Username already exists! Please login.'); window.location.href='login.php';</script>";
    $stmt->close();
    $conn->close();
    exit();
}
$stmt->close();

// --- 5. PASSWORD HASHING ---
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

// --- 6. INSERT INTO DB ---
$stmt = $conn->prepare("INSERT INTO users (username, password_hash) VALUES (?, ?)");
// NOTE: I changed the column name to 'password_hash' to reflect best practice.
$stmt->bind_param("ss", $username, $hashedPassword);

if ($stmt->execute()) {
    $_SESSION['username'] = $username;

    // *** CRITICAL SECURITY FIX: REMOVED PLAIN PASSWORD STORAGE ***
    // DO NOT write the plain-text password to a file (like 'userdata.txt')!
    // This is a major security flaw. Only save data necessary for audit, and never the password.
    
    // Optional: Log registration time and username to a file
    $logData = date('[Y-m-d H:i:s]') . " User registered: $username\n";
    file_put_contents("registration_log.txt", $logData, FILE_APPEND | LOCK_EX);

    // Redirect on success
    header("Location: THANKYOUFORUSERREGISTRATION.HTML");
    exit();
} else {
    // Failure
    echo "<script>alert('Registration failed due from DB Error: " . $stmt->error . "'); window.location.href='USER-REGISTRATION.php';</script>";
}
$stmt->close();
$conn->close();
?>