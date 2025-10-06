<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "student_portal";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $roll = $_POST['roll_no'];
    $email = $_POST['email'];
    $course = $_POST['course'];

    $sql = "INSERT INTO students (name, roll_no, email, course) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $name, $roll, $email, $course);

    if ($stmt->execute()) {
        echo "<script>alert('Student registered successfully!'); window.location.href='view_students.php';</script>";
        exit;
    } else {
        echo "<script>alert('Error: " . $stmt->error . "');</script>";
    }

    $stmt->close();
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Student Registration</title>
<style>
html, body {
  margin: 0;
  padding: 0;
  font-family: "Segoe UI";
  background-color: #0b1a2b;
  color: #ffffff;
  height: 100%;
  display: flex;
  flex-direction: column;
}

header {
  display: flex;
  align-items: center;
  justify-content: space-between;
  background-color: rgba(0, 0, 0, 0.85);
  padding: 10px 30px;
  border-bottom: 3px solid #ffd700;
  flex-wrap: wrap;
}

header a img {
  height: 50px;
  display: block;
}

nav {
  display: flex;
  gap: 15px;
  flex-wrap: wrap;
}

nav a {
  color: #ffffff;
  text-decoration: none;
  font-weight: 600;
  font-size: 0.9em;
  padding: 6px 10px;
  border-radius: 5px;
  transition: background-color 0.3s ease, color 0.3s ease;
}

nav a:hover {
  background-color: #ffd700;
  color: #0b1a2b;
}

main {
  flex: 1;
  max-width: 500px;
  margin: 50px auto;
  padding: 30px;
  background-color: rgba(0, 0, 0, 0.65);
  border-radius: 12px;
  box-shadow: 0 0 15px rgba(0, 0, 0, 0.5);
  text-align: center;
}

main h2 {
  color: #ffd700;
  text-shadow: 1px 1px 3px #000;
  margin-bottom: 20px;
}

label {
  display: block;
  text-align: left;
  font-weight: bold;
  margin: 10px 0 5px 35px;
}

input[type="text"],
input[type="email"] {
  width: 80%;
  padding: 12px;
  font-size: 1em;
  border: none;
  border-radius: 8px;
  margin-bottom: 20px;
  background-color: #fff;
  color: #000;
  box-shadow: 0 0 5px #ffd700;
  transition: box-shadow 0.3s ease, transform 0.2s ease;
}

input[type="text"]:hover,
input[type="email"]:hover {
  box-shadow: 0 0 10px #fffacd;
  transform: scale(1.03);
}

button {
  background-color: #ffd700;
  color: #000;
  padding: 12px 25px;
  border: none;
  border-radius: 10px;
  font-size: 1.1em;
  font-weight: bold;
  cursor: pointer;
  transition: background-color 0.3s ease, transform 0.3s ease, box-shadow 0.3s ease;
}

button:hover {
  background-color: #fffacd;
  transform: scale(1.08);
  box-shadow: 0 0 15px #ffd700;
}

p {
  margin-top: 20px;
  font-size: 0.95em;
}

p a {
  color: #ffd700;
  text-decoration: underline;
}

footer {
  text-align: center;
  font-size: 0.85em;
  padding: 20px;
  background-color: rgba(0, 0, 0, 0.85);
  color: #bbb;
  border-top: 2px solid #ffd700;
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
    <a href="EVENTS.html">EVENTS</a>
    <a href="NEP 2020.html">NEP 2020</a>
    <a href="LEADERBOARD.html">LEADERBOARD</a>
    <a href="ADMISSION.html">ADMISSION</a>
    <a href="ABOUT US.html">ABOUT US</a>
    <a href="FAQs.html">FAQs</a>
  </nav>
</header>

<main>
  <h2>Student Registration Form</h2>
  <form method="POST" action="">
    <label>Full Name</label>
    <input type="text" name="name" placeholder="Enter Full Name" required>

    <label>Roll Number</label>
    <input type="text" name="roll_no" placeholder="Enter Roll Number" required>

    <label>Email</label>
    <input type="email" name="email" placeholder="Enter Email Address" required>

    <label>Course</label>
    <input type="text" name="course" placeholder="Enter Course" required>

    <button type="submit">Register Student</button>
  </form>

  <p>Already registered? <a href="view_students.php">View Students</a></p>
  <p>Want to register as a user instead? <a href="USER-REGISTRATION.php">Click here</a></p>
</main>

<footer>
Trade Marks belong to the respective owners. Copyright © 2025 Info Edge India Ltd. All rights reserved.
</footer>

</body>
</html>
