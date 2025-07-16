<?php
$username = $_SESSION["username"] ?? null;
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Me&Me - Sign In</title>

  <link rel="stylesheet" href="loginstylesheet.css" />
  <link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@600&family=Quicksand:wght@400;600&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
  
</head>

<body>

  <!-- Sign-in Page -->
  <div class="signup-page">
    <div class="signup-form-container">
      <h2>Me&Me</h2>
      <form action = "loginmentor.inc.php" method="post">

          <label for="user"></i> Display name: </label>
          <input type="text" id="user" name="user" maxlength="10" required />

          <label for="password"></i> Password:</label>
          <input type="password" id="password" name="password" required />

          <button type="submit" name = "submit">Mentor Sign In</button>
          <div class="error" id="errorMessage" style="color: rgb(105, 21, 21); margin-top: 10px;"></div>
      </form>
      <p style="margin-top: 1rem; color: #ccc;">Don't have an account? <a href="signup mentor.html" style="color: #6cf;">Sign Up</a></p>
    </div>

  </div>

  <script>
        const phpUser = <?php echo json_encode($username); ?>;
    if (phpUser) {
      localStorage.setItem("loggedInMentor", phpUser);
    }
    function handleLogin(event) {
      event.preventDefault();

      const username = document.getElementById("user").value.trim();

      if (!username) {
        document.getElementById("errorMessage").textContent = "Please enter a username.";
        return false;
      }

      // Simply set loggedInUser and redirect, no validation
      localStorage.setItem("loggedInMentor", username);
      window.location.href = "./index.php";
      return false;
    }
    function goBack(url) {
    window.location.href = url;
}
 // Apply theme based on saved preference
  const theme = localStorage.getItem('theme');
  if (theme === 'dark') {
    document.body.classList.add('dark-mode');
  } else {
    document.body.classList.remove('dark-mode');
  }
  </script>
  <img src="Logo.png" style = "position:absolute; top:0px ; right:0px" height="50px" width = "70px">
<button onclick="goBack('index.php')" style="position:absolute; top:10px; left:10px;">🔙 Back</button>
</body>
</html>
