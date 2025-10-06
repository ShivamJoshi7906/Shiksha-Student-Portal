<?php
// --- PHP LOGIC: DATABASE CONNECTION AND DATA CREATION ---
session_start();

$conn = new mysqli("localhost", "root", "", "student_portal");
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

// Add admin check here (similar to dashboard)

$message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_SPECIAL_CHARS);
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL); // Validates email format
    $password = $_POST['password'];
    $role = $_POST['role'];

    // Basic Validation
    if (empty($username) || empty($password) || !$email) {
        $message = "Error: Username, valid email, and password are required.";
    } elseif (strlen($password) < 8) {
        $message = "Error: Password must be at least 8 characters long.";
    } else {
        // Check if username/email exists
        $stmt_check = $conn->prepare("SELECT id FROM users WHERE username = ? OR email = ?");
        $stmt_check->bind_param("ss", $username, $email);
        $stmt_check->execute();
        $stmt_check->store_result();
        
        if ($stmt_check->num_rows > 0) {
            $message = "Error: Username or email already exists.";
        } else {
            // Password Hashing
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            
            // Secure Insert
            $stmt = $conn->prepare("INSERT INTO users (username, email, password_hash, role) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("ssss", $username, $email, $hashedPassword, $role);
            
            if ($stmt->execute()) {
                echo "<script>alert('User created successfully!');window.location='admin_dashboard.php';</script>";
                exit();
            } else {
                $message = "Error inserting user: " . $stmt->error;
            }
            $stmt->close();
        }
        $stmt_check->close();
    }
}
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8"><title>Create New User</title>
<style>
    /* CSS for form page */
    html, body { margin: 0; padding: 0; font-family: "Segoe UI", sans-serif; background: #0b1a2b; color: #fff; height: 100%; display: flex; flex-direction: column; }
    header { display: flex; justify-content: space-between; align-items: center; background: rgba(0, 0, 0, 0.85); padding: 10px 30px; border-bottom: 3px solid #ffd700; flex-wrap: wrap; }
    header a img { height: 50px; }
    nav { display: flex; flex-wrap: wrap; gap: 12px; }
    nav a { color: #fff; text-decoration: none; font-weight: 600; padding: 6px 10px; border-radius: 5px; font-size: 14px; }
    nav a:hover { background: #ffd700; color: #0b1a2b; }
    main { flex: 1; max-width: 600px; margin: 50px auto; padding: 30px; background: rgba(0, 0, 0, 0.75); border-radius: 12px; text-align: center; box-shadow: 0 0 15px rgba(0, 0, 0, 0.5); }
    main h2 { color: #ffd700; margin-bottom: 20px; }
    input[type="text"], input[type="email"], input[type="password"], select { width: 90%; padding: 12px; margin: 10px 0; border: none; border-radius: 8px; background-color: #fff; color: #000; box-shadow: 0 0 5px #ffd700; }
    button { background: #ffd700; color: #000; padding: 10px 20px; border: none; border-radius: 8px; cursor: pointer; font-weight: bold; }
    button:hover { background: #fffacd; }
    .error { color: #ff6666; margin-bottom: 15px; }
    .btn { display: inline-block; margin-top: 20px; background: #ffd700; color: #000; padding: 8px 16px; border-radius: 6px; text-decoration: none; font-weight: bold; }
</style>
</head>
<body>
    <header>
        <a href="Home.html"><img src="shiksha_logo-removebg-preview.png" alt="Shiksha Logo"></a>
        <nav>
            <a href="Home.html">HOME</a><a href="USER-REGISTRATION.php">USER REGISTRATION</a><a href="FACULTY DETAILS.html">FACULTY DETAILS</a><a href="PLACEMENT.html">PLACEMENT</a><a href="CAREER.html">CAREER</a><a href="events_read.php">EVENTS</a><a href="NEP 2020.html">NEP 2020</a><a href="LEADERBOARD.html">LEADERBOARD</a><a href="ADMISSION.html">ADMISSION</a><a href="ABOUT US.html">ABOUT US</a><a href="FAQs.html">FAQs</a>
        </nav>
    </header>

    <main>
        <h2>Create New User</h2>
        <?php if ($message): ?><p class="error"><?= $message; ?></p><?php endif; ?>
        
        <form method="POST">
            <input type="text" name="username" placeholder="Username (required)" required><br>
            <input type="email" name="email" placeholder="Email (required)" required><br>
            <input type="password" name="password" placeholder="Password (Min 8 chars)" required><br>
            <select name="role">
                <option value="student">Student</option>
                <option value="faculty">Faculty</option>
                <option value="admin">Admin</option>
            </select><br>
            <button type="submit">Create User</button>
        </form>
        <p><a href="admin_dashboard.php" class="btn">Back to Dashboard</a></p>
    </main>

    <footer>
        Trade Marks belong to the respective owners. Copyright © 2025 Info Edge India Ltd. All rights reserved.
    </footer>
</body>
</html>
