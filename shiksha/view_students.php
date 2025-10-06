<?php
$conn = new mysqli("localhost", "root", "", "student_portal");
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$result = $conn->query("SELECT * FROM students");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>View Students</title>
  <style>
    html, body {
      margin: 0;
      padding: 0;
      font-family: "Segoe UI";
      color: #ffffff;
      background-color: #0b1a2b;
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
      transition: transform 0.3s ease;
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
      font-size: 0.95em;
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
      padding: 30px;
      max-width: 90%;
      margin: 40px auto;
      background-color: rgba(0, 0, 0, 0.65);
      border-radius: 12px;
      box-shadow: 0 0 15px rgba(0, 0, 0, 0.5);
    }

    main h2 {
      color: #ffd700;
      text-align: center;
      margin-bottom: 20px;
      text-shadow: 1px 1px 3px #000;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin: 0 auto;
      background-color: rgba(0, 0, 0, 0.4);
      border-radius: 8px;
      overflow: hidden;
      box-shadow: 0 0 10px rgba(255, 215, 0, 0.3);
    }

    th, td {
      border: 1px solid #ffd700;
      padding: 12px;
      text-align: center;
    }

    th {
      background-color: #ffd700;
      color: #000;
    }

    tr:hover {
      background-color: rgba(255, 255, 255, 0.1);
    }

    a.add-link {
      display: inline-block;
      color: #ffd700;
      text-decoration: none;
      font-weight: bold;
      margin-top: 20px;
      text-align: center;
      width: 100%;
    }

    a.add-link:hover {
      color: #fffacd;
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
      <a href="PLACEMENT.HTML">PLACEMENT</a>
      <a href="CAREER.HTML">CAREER</a>
      <a href="EVENTS.HTML">EVENTS</a>
      <a href="NEP 2020.HTML">NEP 2020</a>
      <a href="LEADERBOARD.HTML">LEADERBOARD</a>
      <a href="ADMISSION.HTML">ADMISSION</a>
      <a href="ABOUT US.HTML">ABOUT US</a>
      <a href="FAQs.html">FAQs</a>
    </nav>
  </header>

  <main>
    <h2>Stored Student Records</h2>
    <table>
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Roll No</th>
        <th>Email</th>
        <th>Course</th>
      </tr>
      <?php while($row = $result->fetch_assoc()): ?>
        <tr>
          <td><?= $row['id'] ?></td>
          <td><?= htmlspecialchars($row['name']) ?></td>
          <td><?= htmlspecialchars($row['roll_no']) ?></td>
          <td><?= htmlspecialchars($row['email']) ?></td>
          <td><?= htmlspecialchars($row['course']) ?></td>
        </tr>
      <?php endwhile; ?>
    </table>
    <a class="add-link" href="student_form.php">➕ Add Another Student</a>
  </main>

  <footer>
    Trade Marks belong to the respective owners. Copyright © 2025 Info Edge
    India Ltd. All rights reserved.
  </footer>
</body>
</html>
<?php $conn->close(); ?>
