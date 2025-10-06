<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>USER REGISTRATION</title>
    <style>
      /* ... (Your existing CSS styles remain here) ... */
      html, body {
        margin: 0; padding: 0; font-family: "Segoe UI"; color: #ffffff;
        background-color: #0b1a2b; height: 100%; display: flex;
        flex-direction: column;
      }
      header {
        display: flex; align-items: center; justify-content: space-between;
        background-color: rgba(0, 0, 0, 0.85); padding: 10px 30px;
        border-bottom: 3px solid #ffd700; flex-wrap: wrap;
      }
      header a img {
        height: 50px; display: block; transition: transform 0.3s ease;
      }
      nav {
        display: flex; gap: 15px; flex-wrap: wrap;
      }
      nav a {
        color: #ffffff; text-decoration: none; font-weight: 600;
        font-size: 0.95em; padding: 6px 10px; border-radius: 5px;
        transition: background-color 0.3s ease, color 0.3s ease;
      }
      nav a:hover {
        background-color: #ffd700; color: #0b1a2b;
      }
      main {
        flex: 1; max-width: 500px; margin: 50px auto; padding: 30px;
        background-color: rgba(0, 0, 0, 0.65); border-radius: 12px;
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.5); text-align: center;
      }
      main h2 {
        color: #ffd700; text-shadow: 1px 1px 3px #000; margin-bottom: 10px;
      }
      input[type="text"], input[type="password"] {
        width: 80%; padding: 12px; font-size: 1em; border: none; border-radius: 8px;
        margin-bottom: 20px; background-color: #fff; color: #000;
        box-shadow: 0 0 5px #ffd700; transition: box-shadow 0.3s ease, transform 0.2s ease;
      }
      input[type="text"]:hover, input[type="password"]:hover {
        box-shadow: 0 0 10px #fffacd; transform: scale(1.03);
      }
      input[type="submit"] {
        background-color: #ffd700; color: #000; padding: 12px 25px; border: none;
        border-radius: 10px; font-size: 1.2em; font-weight: bold; cursor: pointer;
        transition: background-color 0.3s ease, transform 0.3s ease, box-shadow 0.3s ease;
      }
      input[type="submit"]:hover {
        background-color: #fffacd; transform: scale(1.08); box-shadow: 0 0 15px #ffd700;
      }
      footer {
        text-align: center; font-size: 0.85em; padding: 20px;
        background-color: rgba(0, 0, 0, 0.85); color: #bbb;
        border-top: 2px solid #ffd700;
      }
    </style>
  </head>
  <body>
    <header>
      <a href="Home.html">
        <img src="shiksha_logo-removebg-preview.png" alt="Shiksha Logo" />
      </a>
      <nav>
        <a href="Home.html">HOME</a>
        <a href="USER-REGISTRATION.php">USER REGISTRATION</a>
        <a href="FACULTY DETAILS.html">FACULTY DETAILS</a>
        <a href="PLACEMENT.HTML">PLACEMENT</a>
        <a href="CAREER.HTML">CAREER</a>
        <a href="events_read.php">EVENTS</a>
        <a href="NEP 2020.HTML">NEP 2020</a>
        <a href="LEADERBOARD.HTML">LEADERBOARD</a>
        <a href="ADMISSION.HTML">ADMISSION</a>
        <a href="ABOUT US.HTML">ABOUT US</a>
        <a href="FAQs.html">FAQs</a>
        <a href="admin_dashboard.php" style="background-color: #ff6666;">MANAGE USERS</a>
      </nav>
    </header>

    <main>
      <h2>Welcome to Registration Portal</h2>
      <form action="register.php" method="POST">

        <h2>Username</h2>
        <input type="text" placeholder="Enter Your Username" name="username" required />

        <h2>Password</h2>
        <input type="password" placeholder="Enter Your Password (Min 8 characters)" name="password" required />

        <h2>Confirm Password</h2>
        <input type="password" placeholder="Confirm Your Password" name="confirmPassword" required />

        <input type="submit" value="Submit Your Data" />
      </form>

      <p>Already have an account? <a href="login.php" style="color:#ffd700; text-decoration:underline;">Login here</a></p>
      <p>Want to register as a student? <a href="student_form.php" style="color:#ffd700; text-decoration:underline;">Click here</a></p>

    </main>

    <footer>
      Trade Marks belong to the respective owners. Copyright © 2025 Info Edge
      India Ltd. All rights reserved.
    </footer>

    <script>
      function redirectToThankYou() {
        const username = document.getElementById("n1").value.trim();
        const password = document.getElementById("n2").value;
        const confirmPassword = document.getElementById("n3").value;

        // Simple validation
        if (!username || !password || !confirmPassword) {
          alert("All fields are required!");
          return false;
        }

        if (password !== confirmPassword) {
          alert("Passwords do not match!");
          return false;
        }

        // Redirect to Thank You page
        window.location.href = "THANKYOUFORUSERREGISTRATION.HTML";
        return false; // prevent default form submission
      }
    </script>
  </body>
</html>