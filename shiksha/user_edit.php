<?php
// --- PHP LOGIC: FETCH AND UPDATE ---
session_start();

$conn = new mysqli("localhost", "root", "", "student_portal");
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

$id = isset($_REQUEST['id']) ? (int)$_REQUEST['id'] : 0;
$user = null;
$message = '';

if ($id === 0) {
    echo "<script>alert('Invalid User ID.');window.location='admin_dashboard.php';</script>";
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = (int)$_POST['id'];
    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_SPECIAL_CHARS);
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    $role = $_POST['role'];

    // Secure Update Query
    $stmt = $conn->prepare("UPDATE users SET username=?, email=?, role=? WHERE id=?");
    $stmt->bind_param("sssi", $username, $email, $role, $id);

    if ($stmt->execute()) {
        echo "<script>alert('User updated successfully!');window.location='admin_dashboard.php';</script>";
        exit();
    } else {
        $message = "Error updating user: " . $stmt->error;
    }
    $stmt->close();
}

// Fetch existing data for display (GET or after failed POST)
$stmt = $conn->prepare("SELECT id, username, email, role FROM users WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $user = $result->fetch_assoc();
} else {
    echo "<script>alert('User not found.');window.location='admin_dashboard.php';</script>";
    $stmt->close();
    $conn->close();
    exit();
}
$stmt->close();
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8"><title>Edit User</title>
<style>
    /* CSS for form page (copied from user_create.php) */
    html, body { margin: 0; padding: 0; font-family: "Segoe UI", sans-serif; background: #0b1a2b; color: #fff; height: 100%; display: flex; flex-direction: column; }
    header { display: flex; justify-content: space-between; align-items: center; background: rgba(0, 0, 0, 0.85); padding: 10px 30px; border-bottom: 3px solid #ffd700; flex-wrap: wrap; }
    header a img { height: 50px; }
    nav { display: flex; flex-wrap: wrap; gap: 12px; }
    nav a { color: #fff; text-decoration: none; font-weight: 600; padding: 6px 10px; border-radius: 5px; font-size: 14px; }
    nav a:hover { background: #ffd700; color: #0b1a2b; }
    main { flex: 1; max-width: 600px; margin: 50px auto; padding: 30px; background: rgba(0, 0, 0, 0.75); border-radius: 12px; text-align: center; box-shadow: 0 0 15px rgba(0, 0, 0, 0.5); }
    main h2 { color: #ffd700; margin-bottom: 20px; }
    input[type="text"], input[type="email"], select { width: 90%; padding: 12px; margin: 10px 0; border: none; border-radius: 8px; background-color: #fff; color: #000; box-shadow: 0 0 5px #ffd700; }
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
        <h2>Edit User: <?= htmlspecialchars($user['username']); ?></h2>
        <?php if ($message): ?><p class="error"><?= $message; ?></p><?php endif; ?>
        
        <form method="POST">
            <input type="hidden" name="id" value="<?= $user['id']; ?>">
            
            <input type="text" name="username" placeholder="Username" value="<?= htmlspecialchars($user['username']); ?>" required><br>
            <input type="email" name="email" placeholder="Email" value="<?= htmlspecialchars($user['email'] ?? ''); ?>"><br>
            <select name="role">
                <option value="student" <?= ($user['role'] === 'student') ? 'selected' : ''; ?>>Student</option>
                <option value="faculty" <?= ($user['role'] === 'faculty') ? 'selected' : ''; ?>>Faculty</option>
                <option value="admin" <?= ($user['role'] === 'admin') ? 'selected' : ''; ?>>Admin</option>
            </select><br>

            <button type="submit">Update User Details</button>
        </form>
        <p><a href="admin_dashboard.php" class="btn">Back to Dashboard</a></p>
    </main>

    <footer>
        Trade Marks belong to the respective owners. Copyright © 2025 Info Edge India Ltd. All rights reserved.
    </footer>
</body>
</html>
