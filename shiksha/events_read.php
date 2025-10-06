<?php
// --- PHP LOGIC: DATABASE CONNECTION AND DATA RETRIEVAL ---
// Note: In a real-world application, you would put the connection in a separate file.
$conn = new mysqli("localhost", "root", "", "student_portal");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch all events, ordered by date descending
$result = $conn->query("SELECT id, title, description, event_date, location FROM events ORDER BY event_date DESC");

// Note: Connection and result set will be closed at the end of the script or automatically.
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>View Events</title>
<style>
    /* --- CSS STYLES (Combined from the previous structure) --- */
    html, body {
        margin: 0;
        padding: 0;
        font-family: "Segoe UI", sans-serif;
        background: #0b1a2b;
        color: #fff;
        height: 100%;
        display: flex;
        flex-direction: column;
    }
    header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        background: rgba(0, 0, 0, 0.85);
        padding: 10px 30px;
        border-bottom: 3px solid #ffd700;
        flex-wrap: wrap;
    }
    header a img { height: 50px; }
    nav { display: flex; flex-wrap: wrap; gap: 12px; }
    nav a {
        color: #fff;
        text-decoration: none;
        font-weight: 600;
        padding: 6px 10px;
        border-radius: 5px;
        font-size: 14px;
        transition: background-color 0.3s ease, color 0.3s ease;
    }
    nav a:hover {
        background: #ffd700;
        color: #0b1a2b;
    }
    main {
        flex: 1; /* Allows main content to grow and push footer down */
        max-width: 900px; /* Increased width for table display */
        margin: 50px auto;
        padding: 30px;
        background: rgba(0, 0, 0, 0.75);
        border-radius: 12px;
        text-align: center;
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.5);
    }
    main h2 {
        color: #ffd700;
        margin-bottom: 20px;
    }
    /* Styles for inputs and textarea are included for completeness but not strictly needed here */
    input, textarea {
        width: 90%; padding: 10px; margin: 10px 0;
        border: none; border-radius: 8px;
    }
    a.btn {
        background: #ffd700;
        color: #000;
        padding: 6px 12px;
        border-radius: 6px;
        text-decoration: none;
        font-weight: bold;
        display: inline-block;
        transition: background-color 0.3s ease;
        margin: 2px; /* Small margin for actions buttons */
    }
    a.btn:hover { background: #fffacd; }
    table {
        width: 100%;
        border-collapse: collapse;
        color: #fff;
        margin-top: 15px;
    }
    th, td {
        border: 1px solid #ffd700;
        padding: 10px;
        text-align: left;
    }
    th {
        background: #ffd700;
        color: #0b1a2b; /* Changed from black to match nav:hover color for contrast */
        font-weight: bold;
        text-align: center;
    }
    td {
        background: rgba(0, 0, 0, 0.4);
        vertical-align: middle;
    }
    /* Specific styles for better table readability */
    td:nth-child(1) { width: 5%; text-align: center; } /* ID */
    td:nth-child(4) { width: 15%; white-space: nowrap; } /* Date */
    td:nth-child(6) { width: 15%; text-align: center; white-space: nowrap; } /* Actions */

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
        <h2>All Events</h2>
        <p><a href="events_create.php" class="btn">Add New Event</a></p>

        <table>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Description</th>
                <th>Date</th>
                <th>Location</th>
                <th>Actions</th>
            </tr>
            <?php
            // Check if there are rows returned
            if ($result->num_rows > 0) {
                // Loop through each row of the result set
                while($row = $result->fetch_assoc()):
            ?>
                <tr>
                    <td><?= $row['id']; ?></td>
                    <td><?= htmlspecialchars($row['title']); ?></td>
                    <td><?= htmlspecialchars(substr($row['description'], 0, 100)); ?>...</td> <td><?= date('M d, Y', strtotime($row['event_date'])); ?></td>
                    <td><?= htmlspecialchars($row['location']); ?></td>
                    <td>
                        <a href="events_update.php?id=<?= $row['id']; ?>" class="btn">Edit</a>
                        <a href="events_delete.php?id=<?= $row['id']; ?>" class="btn" onclick="return confirm('Are you sure you want to delete this event?')">Delete</a>
                    </td>
                </tr>
            <?php
                endwhile;
            } else {
                // Display a message if no events are found
                echo '<tr><td colspan="6" style="text-align:center; color:#ffd700;">No events found. Start by adding one!</td></tr>';
            }
            ?>
        </table>
        <?php 
        // Close the result set and connection after table rendering is complete
        if (isset($result)) $result->free();
        if (isset($conn)) $conn->close();
        ?>
    </main>

    <footer>
        Trade Marks belong to the respective owners.  
        Copyright © 2025 Info Edge India Ltd. All rights reserved.
    </footer>
</body>
</html>