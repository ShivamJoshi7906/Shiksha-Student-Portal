<?php
session_start();
if(!isset($_SESSION['username'])){
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Dashboard</title>
<style>
/* Global Style */
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

/* Header */
header { 
  display:flex; 
  justify-content:space-between; 
  align-items:center;   /* ensures logo + nav are centered vertically */
  background:rgba(0,0,0,0.85); 
  padding:10px 30px; 
  border-bottom:3px solid #ffd700; 
  flex-wrap:nowrap;   /* prevent wrapping */
}

header a img { 
  height:40px;       /* reduce slightly to match nav text */
  vertical-align:middle; /* align middle with text */
}

nav { 
  display:flex; 
  gap:20px; 
  flex-wrap:nowrap; 
  align-items:center;  /* ensures nav items are aligned with logo */
}

nav a {
  color:#fff;
  text-decoration:none;
  font-weight:600;
  padding:6px 8px;      /* reduce padding */
  border-radius:5px;
  font-size:14px;       /* smaller font size */
}
nav a:hover {
  background: #ffd700;
  color: #0b1a2b;
}

/* Dashboard Content */
main {
  flex: 1;
  display: flex;
  justify-content: center;
  align-items: center;
  padding: 40px 20px;
}

.dashboard-box {
  max-width: 700px;
  width: 100%;
  background: rgba(0,0,0,0.75);
  padding: 40px;
  border-radius: 15px;
  text-align: center;
  box-shadow: 0px 4px 12px rgba(0,0,0,0.5);
}

.dashboard-box h2 {
  font-size: 28px;
  margin-bottom: 15px;
  color: #ffd700;
}
.dashboard-box p {
  font-size: 16px;
  color: #d1d1d1;
  margin-bottom: 25px;
}

button {
  background: #ffd700;
  color: #000;
  padding: 12px 24px;
  border: none;
  border-radius: 8px;
  cursor: pointer;
  font-weight: bold;
  font-size: 16px;
  transition: 0.3s;
}
button:hover {
  background: #fffacd;
}

/* Footer */
footer {
  text-align: center;
  padding: 18px;
  background: rgba(0,0,0,0.9);
  color: #bbb;
  border-top: 2px solid #ffd700;
  font-size: 14px;
}
</style>
</head>
<body>

<header>
  <a href="Home.html"><img src="shiksha_logo-removebg-preview.png" alt="Logo"></a>
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
    <a href="logout.php">LOGOUT</a>
  </nav>
</header>

<main>
  <div class="dashboard-box">
    <h2>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h2>
    <p>You are now logged in and can access the protected dashboard content.</p>
    <form action="logout.php" method="POST">
      <button type="submit">Logout</button>
    </form>
  </div>
</main>

<footer>
  Trade Marks belong to the respective owners. Copyright © 2025 Info Edge India Ltd. All rights reserved.
</footer>

</body>
</html>
