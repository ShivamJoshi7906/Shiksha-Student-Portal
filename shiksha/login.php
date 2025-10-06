<!-- <!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login</title>
<style>
/* Copy the same CSS from your registration page for consistency */
html, body { margin:0; padding:0; font-family:"Segoe UI"; background:#0b1a2b; color:#fff; height:100%; display:flex; flex-direction:column; }
header { display:flex; justify-content:space-between; align-items:center; background:rgba(0,0,0,0.85); padding:10px 30px; border-bottom:3px solid #ffd700; flex-wrap:wrap; }
header a img { height:50px; }
nav { display:flex; gap:15px; flex-wrap:wrap; }
nav a { color:#fff; text-decoration:none; font-weight:600; padding:6px 10px; border-radius:5px; }
nav a:hover { background:#ffd700; color:#0b1a2b; }
main { flex:1; max-width:500px; margin:50px auto; padding:30px; background:rgba(0,0,0,0.65); border-radius:12px; text-align:center; }
input[type="text"], input[type="password"] { width:80%; padding:12px; margin-bottom:20px; border:none; border-radius:8px; }
input[type="submit"] { background:#ffd700; color:#000; padding:12px 25px; border:none; border-radius:10px; cursor:pointer; }
footer { text-align:center; padding:20px; background:rgba(0,0,0,0.85); color:#bbb; border-top:2px solid #ffd700; }
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
  </nav>
</header>

<main>
  <h2>Login</h2>
  <form action="login_process.php" method="POST">
    <input type="text" name="username" placeholder="Enter Your Username" required><br>
    <input type="password" name="password" placeholder="Enter Your Password" required><br>
    <input type="submit" value="Login">
  </form>
</main>

<footer>
Trade Marks belong to the respective owners. Copyright © 2025 Info Edge India Ltd.
</footer>
</body>
</html> -->
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login - Shiksha</title>
<style>
/* Global Styles */
html, body {
  margin: 0;
  padding: 0;
  font-family: "Segoe UI";
  color: #fff;
  background-color: #0b1a2b;
  height: 100%;
  display: flex;
  flex-direction: column;
}

/* Header Styles */
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

/* Main Login Box */
main {
  flex: 1;
  display: flex;
  justify-content: center;
  align-items: center;
}

.login-box {
  background-color: rgba(0, 0, 0, 0.65);
  padding: 40px;
  border-radius: 12px;
  box-shadow: 0 0 15px rgba(0,0,0,0.5);
  text-align: center;
  width: 100%;
  max-width: 400px;
}

.login-box h2 {
  color: #ffd700;
  margin-bottom: 25px;
  text-shadow: 1px 1px 3px #000;
}

.login-box input[type="text"],
.login-box input[type="password"] {
  width: 90%;
  padding: 12px;
  margin-bottom: 20px;
  border: none;
  border-radius: 8px;
  font-size: 1em;
  background-color: #fff;
  color: #000;
  box-shadow: 0 0 5px #ffd700;
  transition: box-shadow 0.3s ease, transform 0.2s ease;
}

.login-box input[type="text"]:hover,
.login-box input[type="password"]:hover {
  box-shadow: 0 0 10px #fffacd;
  transform: scale(1.03);
}

.login-box input[type="submit"] {
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

.login-box input[type="submit"]:hover {
  background-color: #fffacd;
  transform: scale(1.05);
  box-shadow: 0 0 15px #ffd700;
}

/* Footer Styles */
footer {
  text-align: center;
  font-size: 0.85em;
  padding: 20px;
  background-color: rgba(0, 0, 0, 0.85);
  color: #bbb;
  border-top: 2px solid #ffd700;
  flex-shrink: 0;
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
  </nav>
</header>

<main>
  <div class="login-box">
    <h2>Welcome to Login Portal</h2>
    <form action="login_process.php" method="POST">
      <h2>Username</h2>
      <input type="text" name="username" placeholder="Enter Your Username" required><br>

      <h2>Password</h2>
      <input type="password" name="password" placeholder="Enter Your Password" required><br>
      <input type="submit" value="Login">
    </form>
    <p style="margin-top:15px; color:#ffd700;">Don't have an account? <a href="USER-REGISTRATION.php" style="color:#fffacd;">Register here</a></p>
  </div>
</main>

<footer>
  Trade Marks belong to the respective owners. Copyright © 2025 Info Edge India Ltd.
</footer>

</body>
</html>
