<?php
// --- PHP LOGIC: DATABASE CONNECTION AND DATA HANDLING ---
$conn = new mysqli("localhost", "root", "", "student_portal");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// 1. --- HANDLE FORM SUBMISSION (POST) ---
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the ID from the hidden input field in the submitted form
    $id = isset($_POST['id']) ? (int)$_POST['id'] : 0;
    $title = $_POST['title'];
    $desc = $_POST['description'];
    $date = $_POST['event_date'];
    $loc = $_POST['location'];

    // Ensure a valid ID was passed
    if ($id > 0) {
        // Use prepared statement for UPDATE query
        $stmt = $conn->prepare("UPDATE events SET title=?, description=?, event_date=?, location=? WHERE id=?");
        $stmt->bind_param("ssssi", $title, $desc, $date, $loc, $id);

        if ($stmt->execute()) {
            echo "<script>alert('Event updated successfully!');window.location='events_read.php';</script>";
        } else {
            echo "<script>alert('Error updating event: " . $stmt->error . "');</script>";
        }
        $stmt->close();
    } else {
        echo "<script>alert('Error: Invalid Event ID for update.');window.location='events_read.php';</script>";
    }
    // No need to fetch event data if we just finished updating, so we exit.
    $conn->close();
    exit();
}

// 2. --- FETCH EXISTING DATA FOR THE FORM (GET) ---
// Get ID from URL parameter (GET request)
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($id === 0) {
    echo "<script>alert('Error: No Event ID specified.');window.location='events_read.php';</script>";
    $conn->close();
    exit();
}

// Use prepared statement for SELECT query (Security Improvement)
$stmt = $conn->prepare("SELECT id, title, description, event_date, location FROM events WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$stmt->close();

// Check if the event was found
if (!$row) {
    echo "<script>alert('Error: Event not found.');window.location='events_read.php';</script>";
    $conn->close();
    exit();
}
// Close connection after fetching data
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Edit Event</title>
<style>
    /* --- CSS STYLES (Combined) --- */
    html, body {
        margin: 0; padding: 0;
        font-family: "Segoe UI", sans-serif;
        background: #0b1a2b; color: #fff;
        height: 100%;
        display: flex; flex-direction: column;
    }
    header {
        display: flex; justify-content: space-between; align-items: center;
        background: rgba(0, 0, 0, 0.85);
        padding: 10px 30px;
        border-bottom: 3px solid #ffd700;
        flex-wrap: wrap;
    }
    header a img { height: 50px; }
    nav { display: flex; flex-wrap: wrap; gap: 12px; }
    nav a {
        color: #fff; text-decoration: none; font-weight: 600;
        padding: 6px 10px; border-radius: 5px; font-size: 14px;
        transition: background-color 0.3s ease, color 0.3s ease;
    }
    nav a:hover {
        background: #ffd700; color: #0b1a2b;
    }
    main {
        flex: 1;
        max-width: 800px; margin: 50px auto; padding: 30px;
        background: rgba(0, 0, 0, 0.75); border-radius: 12px;
        text-align: center;
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.5);
    }
    main h2 {
        color: #ffd700;
        margin-bottom: 20px;
    }
    input[type="text"],
    input[type="date"],
    textarea {
        width: 90%;
        padding: 12px;
        margin: 10px 0;
        border: none;
        border-radius: 8px;
        background-color: #fff;
        color: #000;
        box-shadow: 0 0 5px #ffd700;
    }
    button {
        background: #ffd700;
        color: #000;
        padding: 10px 20px;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        font-weight: bold;
        font-size: 1.1em;
        transition: background-color 0.3s ease, transform 0.2s ease;
    }
    button:hover {
        background: #fffacd;
        transform: scale(1.05);
    }
    a.btn {
        display: inline-block;
        margin-top: 20px;
        background: #ffd700;
        color: #000;
        padding: 8px 16px;
        border-radius: 6px;
        text-decoration: none;
        font-weight: bold;
        transition: background-color 0.3s ease;
    }
    a.btn:hover { background: #fffacd; }
    footer {
        text-align: center;
        padding: 20px;
        background: rgba(0, 0, 0, 0.85);
        color: #bbb;
        border-top: 2px solid #ffd700;
        font-size: 0.85em;
    }
</style>
</head>
<body>
    <header>
        <a href="Home.html">
            <img src="shiksha_logo-removebg-preview.png" alt="Shiksha Logo">
        </a>
        <nav>
            <a href="Home.html">HOME</a>
            <a href="USER-REGISTRATION.php">USER REGISTRATION</a>
            <a href="FACULTY DETAILS.html">FACULTY DETAILS</a>
            <a href="PLACEMENT.html">PLACEMENT</a>
            <a href="CAREER.html">CAREER</a>
            <a href="events_read.php">EVENTS</a>
            <a href="NEP 2020.html">NEP 2020</a>
            <a href="LEADERBOARD.html">LEADERBOARD</a>
            <a href="ADMISSION.html">ADMISSION</a>
            <a href="ABOUT US.html">ABOUT US</a>
            <a href="FAQs.html">FAQs</a>
        </nav>
    </header>

    <main>
        <h2>Edit Event (ID: <?= $row['id']; ?>)</h2>
        <form method="POST">
            <input type="hidden" name="id" value="<?= $row['id']; ?>">

            <input type="text" name="title" placeholder="Event Title" value="<?= htmlspecialchars($row['title']); ?>" required><br>
            
            <textarea name="description" placeholder="Event Description" required><?= htmlspecialchars($row['description']); ?></textarea><br>
            
            <input type="date" name="event_date" value="<?= $row['event_date']; ?>" required><br>
            
            <input type="text" name="location" placeholder="Event Location" value="<?= htmlspecialchars($row['location']); ?>" required><br>
            
            <button type="submit">Update Event</button>
        </form>
        <p><a href="events_read.php" class="btn">Back to Events</a></p>
    </main>

    <footer>
        Trade Marks belong to the respective owners.  
        Copyright © 2025 Info Edge India Ltd. All rights reserved.
    </footer>
</body>
</html>