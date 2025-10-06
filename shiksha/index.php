<?php
session_start();
if (isset($_SESSION['username'])) {
    header("Location: dashboard.php");
    exit();
}

$savedUser = $_COOKIE['remember_user'] ?? '';

$popupMessage = '';
if (isset($_GET['msg'])) {
    if ($_GET['msg'] === 'registered') $popupMessage = 'Registration successful. Please login.';
    if ($_GET['msg'] === 'logged_out') $popupMessage = 'Logged out successfully.';
}
if (isset($_GET['error'])) {
    if ($_GET['error'] === 'username_taken') $popupMessage = 'Username already exists!';
    if ($_GET['error'] === 'invalid_credentials') $popupMessage = 'Invalid username or password!';
    if ($_GET['error'] === 'db') $popupMessage = 'Database error. Try again later.';
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>USER REGISTRATION</title>
    <style>
      /* (Keep your original CSS) */
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
      }
      header a img { height: 50px; display: block; transition: transform 0.3s ease; }
      header h1 { margin: 0; font-size: 2em; color: #ffd700; text-shadow: 2px 2px 5px #000; flex-grow: 1; padding-left: 15px; }
      nav { display: flex; gap: 15px; flex-wrap: wrap; }
      nav a { color: #ffffff; text-decoration: none; font-weight: 600; font-size: 0.95em; padding: 6px 10px; border-radius: 5px; transition: background-color 0.3s ease, color 0.3s ease; }
      nav a:hover { background-color: #ffd700; color: #0b1a2b; }
      main { flex: 1; max-width: 500px; margin: 50px auto; padding: 30px; background-color: rgba(0, 0, 0, 0.65); border-radius: 12px; box-shadow: 0 0 15px rgba(0, 0, 0, 0.5); text-align: center; }
      main h2 { color: #ffd700; text-shadow: 1px 1px 3px #000; margin-bottom: 10px; }
      input[type="text"], input[type="password"] { width: 80%; padding: 12px; font-size: 1em; border: none; border-radius: 8px; margin-bottom: 20px; background-color: #fff; color: #000; box-shadow: 0 0 5px #ffd700; transition: box-shadow 0.3s ease, transform 0.2s ease; }
      input[type="text"]:hover, input[type="password"]:hover { box-shadow: 0 0 10px #fffacd; transform: scale(1.03); }
      input[type="submit"] { background-color: #ffd700; color: #000; padding: 12px 25px; border: none; border-radius: 10px; font-size: 1.2em; font-weight: bold; cursor: pointer; transition: background-color 0.3s ease, transform 0.3s ease, box-shadow 0.3s ease; }
      input[type="submit"]:hover { background-color: #fffacd; transform: scale(1.08); box-shadow: 0 0 15px #ffd700; }
      footer { text-align: center; font-size: 0.85em; padding: 20px; background-color: rgba(0, 0, 0, 0.85); color: #bbb; border-top: 2px solid #ffd700; }
      #popupModal { display: none; position: fixed; top: 0; left: 0; width: 100vw; height: 100vh; background: rgba(0, 0, 0, 0.6); z-index: 9999; align-items: center; justify-content: center; }
      #popupModal .popup-content { background: #fff; color: #222; padding: 30px 40px; border-radius: 16px; box-shadow: 0 0 20px #ffd700; text-align: center; min-width: 260px; max-width: 90vw; }
      #popupModal button { background: #ffd700; color: #222; border: none; border-radius: 8px; padding: 10px 24px; font-size: 1em; font-weight: bold; cursor: pointer; }
    </style>
  </head>
  <body>
    <header>
      <a href="Home.html"><img src="shiksha_logo-removebg-preview.png" alt="Shiksha Logo" /></a>
      <nav>
        <a href="Home.html">HOME</a>
        <a href="index.php">USER REGISTRATION</a>
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
      <h2>New User? Register Below</h2>
      <form onsubmit="return validateRegister()" action="register.php" method="POST">
        <h2>Username</h2>
        <input type="text" placeholder="Enter Your Username" id="n1" name="username" />

        <h2>Password</h2>
        <input type="password" placeholder="Enter Your Password" id="n2" name="password" />

        <h2>Confirm Password</h2>
        <input type="password" placeholder="Confirm Your Password" id="n3" name="confirmPassword" />

        <input type="submit" value="Register" />
      </form>

      <hr style="margin:30px 0; border:1px solid #ffd700;">

      <h2>Already Registered? Login Here</h2>
      <form onsubmit="return validateLogin()" action="login.php" method="POST">
        <h2>Username</h2>
        <input type="text" placeholder="Enter Your Username" id="l1" name="username" value="<?php echo htmlspecialchars($savedUser); ?>" />

        <h2>Password</h2>
        <input type="password" placeholder="Enter Your Password" id="l2" name="password" />

        <label style="display:block; margin:10px 0;">
          <input type="checkbox" name="remember" /> Remember Me
        </label>

        <input type="submit" value="Login" />
      </form>
    </main>

    <footer>
      Trade Marks belong to the respective owners. Copyright © 2025 Info Edge
      India Ltd. All rights reserved.
    </footer>

    <div id="popupModal">
      <div class="popup-content">
        <span id="popupMessage" style="font-size: 1.15em"></span><br /><br />
        <button onclick="closePopup()">OK</button>
      </div>
    </div>

    <script>
      function showPopup(message) {
        document.getElementById("popupMessage").textContent = message;
        document.getElementById("popupModal").style.display = "flex";
      }
      function closePopup() {
        document.getElementById("popupModal").style.display = "none";
        // remove query params from URL after user closes (clean)
        if (window.history.replaceState) {
          const url = new URL(window.location);
          url.search = '';
          window.history.replaceState({}, document.title, url.toString());
        }
      }

      function validateRegister() {
        const u = document.getElementById("n1").value.trim();
        const p = document.getElementById("n2").value;
        const c = document.getElementById("n3").value;
        if (!u || !p || !c) { showPopup("All registration fields are required!"); return false; }
        if (p !== c) { showPopup("Passwords do not match!"); return false; }
        return true;
      }
      function validateLogin() {
        const u = document.getElementById("l1").value.trim();
        const p = document.getElementById("l2").value;
        if (!u || !p) { showPopup("Both username and password are required!"); return false; }
        return true;
      }

      // show server-side popup message (if any)
      document.addEventListener('DOMContentLoaded', function () {
        const msg = <?php echo json_encode($popupMessage); ?>;
        if (msg) showPopup(msg);
      });
    </script>
  </body>
</html>
