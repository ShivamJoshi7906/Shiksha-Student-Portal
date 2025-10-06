<?php
session_start();

// Database connection
$conn = new mysqli("localhost", "root", "", "student_portal");
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

// --- SECURITY CHECK: Assume role-based access for demonstration ---
// In a real application, you would check the logged-in user's role here.
/*
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'admin') {
    header('Location: login.php');
    exit();
}
*/

// Fetch all users (NEVER select the password_hash)
$result = $conn->query("SELECT id, username, email, role, created_at FROM users ORDER BY created_at DESC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin Dashboard - Manage Users</title>
<style>
    /* --- CSS STYLES (Admin Dashboard Specific) --- */
    html, body { margin: 0; padding: 0; font-family: "Segoe UI", sans-serif; background: #0b1a2b; color: #fff; height: 100%; display: flex; flex-direction: column; }
    header { display: flex; justify-content: space-between; align-items: center; background: rgba(0, 0, 0, 0.85); padding: 10px 30px; border-bottom: 3px solid #ffd700; flex-wrap: wrap; }
    header a img { height: 50px; }
    nav { display: flex; flex-wrap: wrap; gap: 12px; }
    nav a { color: #fff; text-decoration: none; font-weight: 600; padding: 6px 10px; border-radius: 5px; font-size: 14px; transition: background-color 0.3s ease, color 0.3s ease; }
    nav a:hover { background: #ffd700; color: #0b1a2b; }
    main { flex: 1; max-width: 1100px; margin: 50px auto; padding: 30px; background: rgba(0, 0, 0, 0.75); border-radius: 12px; text-align: center; box-shadow: 0 0 15px rgba(0, 0, 0, 0.5); }
    main h2 { color: #ffd700; margin-bottom: 20px; }
    a.btn { background: #ffd700; color: #000; padding: 6px 12px; border-radius: 6px; text-decoration: none; font-weight: bold; display: inline-block; transition: background-color 0.3s ease; margin: 2px; }
    a.btn:hover { background: #fffacd; }
    table { width: 100%; border-collapse: collapse; color: #fff; margin-top: 15px; }
    th, td { border: 1px solid #ffd700; padding: 10px; text-align: left; }
    th { background: #ffd700; color: #0b1a2b; font-weight: bold; text-align: center; }
    td { background: rgba(0, 0, 0, 0.4); vertical-align: middle; }
    td:nth-child(1) { width: 5%; text-align: center; } /* ID */
    td:nth-child(5) { width: 18%; text-align: center; white-space: nowrap; } /* Actions */
    footer { text-align: center; padding: 20px; background: rgba(0, 0, 0, 0.85); color: #bbb; border-top: 2px solid #ffd700; font-size: 0.85em; }
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
        <h2>Admin User Management Dashboard</h2>
        <p><a href="user_create.php" class="btn">Add New User</a></p>

        <table>
            <tr>
                <th>ID</th><th>Username</th><th>Email</th><th>Role</th><th>Registered</th><th>Actions</th>
            </tr>
            <?php
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()):
            ?>
                <tr>
                    <td><?= $row['id']; ?></td>
                    <td><?= htmlspecialchars($row['username']); ?></td>
                    <td><?= htmlspecialchars($row['email'] ?? 'N/A'); ?></td>
                    <td><?= htmlspecialchars($row['role'] ?? 'Student'); ?></td>
                    <td><?= date('Y-m-d', strtotime($row['created_at'])); ?></td>
                    <td>
                        <a href="user_edit.php?id=<?= $row['id']; ?>" class="btn">Edit</a>
                        <a href="user_delete.php?id=<?= $row['id']; ?>" class="btn" onclick="return confirm('WARNING: Delete user <?= htmlspecialchars($row['username']); ?>?')">Delete</a>
                    </td>
                </tr>
            <?php
                endwhile;
            } else {
                echo '<tr><td colspan="6" style="text-align:center; color:#ffd700;">No users found.</td></tr>';
            }
            ?>
        </table>
        <?php 
        if (isset($result)) $result->free();
        $conn->close();
        ?>
    </main>

    <footer>
        Trade Marks belong to the respective owners. Copyright © 2025 Info Edge India Ltd. All rights reserved.
    </footer>
</body>
</html>