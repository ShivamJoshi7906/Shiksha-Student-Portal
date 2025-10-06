<?php
// Set up database connection
$conn = new mysqli("localhost", "root", "", "student_portal");

// Check connection
if ($conn->connect_error) {
    // If connection fails, stop execution and display error
    die("Connection failed: " . $conn->connect_error);
}

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // 1. Retrieve data from the POST request
    $title = $_POST['title'];
    $desc = $_POST['description'];
    $date = $_POST['event_date'];
    $loc = $_POST['location'];

    // 2. Prepare and execute the SQL INSERT statement
    $stmt = $conn->prepare("INSERT INTO events(title, description, event_date, location) VALUES(?, ?, ?, ?)");
    $stmt->bind_param("ssss", $title, $desc, $date, $loc);

    if ($stmt->execute()) {
        // Success: Use JavaScript to alert and redirect
        echo "<script>alert('Event added successfully');window.location='events_read.php';</script>";
    } else {
        // Failure: Show the specific SQL error for debugging
        echo "<script>alert('Error: " . $stmt->error . "');</script>";
    }

    // Close the statement
    $stmt->close();
}

// Close the connection (will be reopened if the page is just loaded, not submitted)
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Event</title>
    <style>
        /* --- CSS STYLES --- */
        html, body {
            margin: 0;
            padding: 0;
            font-family: "Segoe UI", sans-serif;
            background: #0b1a2b;
            color: #fff;
            height: 100%;
            display: flex;
            flex-direction: column; /* To push footer to bottom */
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
            max-width: 800px;
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
        /* Table styles from the original CSS are kept but not needed for this form */
        /* th, td { border:1px solid #ffd700; padding:10px; } */
        /* th { background:#ffd700; color:#000; } */
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
        <h2>Create New Event</h2>
        <form method="POST">
            <input type="text" name="title" placeholder="Event Title" required><br>
            <textarea name="description" placeholder="Event Description" required></textarea><br>
            <input type="date" name="event_date" required><br>
            <input type="text" name="location" placeholder="Event Location" required><br>
            <button type="submit">Add Event</button>
        </form>
        <p><a href="events_read.php" class="btn">View All Events</a></p>
    </main>

    <footer>
        Trade Marks belong to the respective owners.  
        Copyright © 2025 Info Edge India Ltd. All rights reserved.
    </footer>
</body>
</html>