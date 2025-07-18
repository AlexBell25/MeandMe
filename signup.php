<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Me&Me</title>

  <link rel="stylesheet" href="loginstylesheet.css" />
  <link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@600&family=Quicksand:wght@400;600&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
  
  <style>
    /* Minimal styling for nav */
    nav {
      display: flex;
      justify-content: flex-end;
      gap: 10px;
      padding: 15px 30px;
      background-color: #222;
    }

    nav button {
      background-color: #444;
      color: white;
      border: none;
      padding: 8px 16px;
      border-radius: 4px;
      font-family: 'Quicksand', sans-serif;
      font-size: 14px;
      cursor: pointer;
    }
  </style>
</head>

<body>

  <!-- Sign-up Page -->
  <div class="signup-page">
    <div class="signup-form-container">
      <h2>Me&Me</h2>
      <form action ="signup.inc.php" method="post">

          <label for="user"> Username:</label>
          <input type="text" id="user" name="user" maxlength="10" required />
          <input type="hidden" name="role" value="mentee" />

          <label for="email"> Email:</label>
          <input type="email" id="email" name="email" required />

          <label for="password"> Password:</label>
          <input type="password" id="password" name="password" required />

          <label for="confirmPassword"> Confirm:</label>
          <input type="password" id="confirmPassword" name="confirmPassword" required />

          <button type="submit" name = "submit">Register</button>
          <div class="error" id="errorMessage" style="color: rgb(105, 21, 21); margin-top: 10px;"></div>
      </form>
      <p style="margin-top: 1rem; color: #ccc;">Already have an account? <a href="login.php" style="color: #6cf;">Sign in</a></p>
    </div>

    
  </div>

  <!-- JavaScript -->
  <script>
    function validatePasswords() {
      const pass = document.getElementById("password").value;
      const confirm = document.getElementById("confirmPassword").value;
      const errorDiv = document.getElementById("errorMessage");

      if (pass !== confirm) {
        errorDiv.textContent = "Passwords do not match.";
        return false;
      }

      errorDiv.textContent = "";
      return true;
    }

function handleRegistration(event) {
  event.preventDefault();

  if (!validatePasswords()) return false;

  const username = document.getElementById("user").value;
  localStorage.setItem("loggedInUser", username);

  // Redirect to gameSelector.html
  window.location.href = "./index.php";
  return false;
}


    function goToLogin() {
      window.location.href = "login.php"; // Create this page if needed
    }

    function goToSignup() {
      window.location.href = "signup.php"; // Optional
    }

    function goToProfile() {
      window.location.href = "profile.html"; // Create a profile page if needed
    }

    function logout() {
      localStorage.removeItem("loggedInUser");
      location.reload();
    }

    function updateNavbar() {
      const user = localStorage.getItem("loggedInUser");
      const nav = document.getElementById("navbar");

      if (user) {
        nav.innerHTML = `
          <button onclick="goToProfile()">Profile</button>
          <button onclick="logout()">Logout</button>
        `;
      }
    }

    document.addEventListener("DOMContentLoaded", updateNavbar);
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
