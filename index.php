<?php
session_start();
if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit();
}
$username = $_SESSION["username"];
// Show logged-in page
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Mentorship App</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Segoe UI', sans-serif;
      background-color: #ffffff;
      color: #2b2b2b;
      padding-bottom: 70px;
      transition: background-color 0.3s, color 0.3s;
    }

    body.dark-mode {
      background-color: #121212;
      color: #e0e0e0;
    }

    .header {
      background-color: #a5c4bb;
      padding: 30px 20px 40px;
      border-bottom-left-radius: 60px;
      border-bottom-right-radius: 60px;
      text-align: center;
      transition: background-color 0.3s;
    }

    body.dark-mode .header {
      background-color: #2a2a2a;
    }

    .header img {
      width: 80px;
      height: 80px;
      border-radius: 50%;
      display: block;
      margin: 0 auto 10px;
    }

    .header h2 {
      font-size: 18px;
      color: #444;
    }

    body.dark-mode .header h2 {
      color: #ccc;
    }

    .bottom-nav {
      position: fixed;
      bottom: 0;
      width: 100%;
      height: 70px;
      background-color: #f0f3f2;
      border-top: 1px solid #ccc;
      display: flex;
      justify-content: space-between;
      z-index: 1000;
      user-select: none;
      transition: background-color 0.3s, border-color 0.3s;
    }

    body.dark-mode .bottom-nav {
      background-color: #1e1e1e;
      border-top-color: #444;
    }

    .nav-tab {
      flex-grow: 1;
      text-align: center;
      padding: 6px 5px 4px;
      cursor: pointer;
      border-top: 3px solid transparent;
      transition: border-color 0.3s ease, color 0.3s ease;
      font-size: 12px;
      color: #555;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      gap: 4px;
      white-space: nowrap;
    }

    .nav-tab i {
      font-size: 18px;
      color: gray;
      transition: color 0.3s;
    }

    .nav-tab.active {
      border-top-color: #6b52b8;
      color: #6b52b8;
    }

    .nav-tab.active i {
      color: #6b52b8;
    }

    body.dark-mode .nav-tab {
      color: #ccc;
    }

    body.dark-mode .nav-tab i {
      color: #aaa;
    }

    .mentor-tab {
      border-right: 1px solid #ccc;
    }

    .user-tab {
      border-left: 1px solid #ccc;
    }

    body.dark-mode .mentor-tab,
    body.dark-mode .user-tab {
      border-color: #444;
    }

    @media (max-width: 400px) {
      .nav-tab {
        font-size: 10px;
      }

      .nav-tab i {
        font-size: 14px;
      }
    }

    .hidden {
      display: none !important;
    }
  </style>
</head>
<body>
  <div class="header">
    <img id="mainProfileImage" src="profile.png" alt="Profile Icon" />
    <h2>WELCOME USER!</h2>
  </div>

  <div class="bottom-nav" id="bottomNav" role="tablist">
    <div id="mentorTab" class="nav-tab mentor-tab" onclick="mentorTabClick()">
      <i class="fas fa-user-tie"></i>
      <span id="mentorTabLabel">Mentor Login</span>
    </div>
    <div id="tabMessages" class="nav-tab" data-tab="1" onclick="messagesStarTab()">
      <i class="fas fa-comment"></i>
      <span>Messages</span>
    </div>
    <div id="tabCalendar" class="nav-tab" data-tab="2" onclick="calendarsStarTab()">
      <i class="fas fa-calendar"></i>
      <span>Calendar</span>
    </div>
    <div id="tabRecs" class="nav-tab" data-tab="3" onclick="reccomendationsStarTab()">
      <i class="fas fa-user-circle"></i>
      <span>Recommendations</span>
    </div>
    <div id="tabConnections" class="nav-tab" data-tab="4" onclick="connectionsStarTab()">
      <i class="fas fa-handshake"></i>
      <span>Connections</span>
    </div>
    <div id="tabSettings" class="nav-tab" data-tab="5" onclick="settingsStarTab()">
      <i class="fas fa-cog"></i>
      <span>Settings</span>
    </div>
    <div id="userTab" class="nav-tab user-tab" onclick="userTabClick()">
      <i class="fas fa-user"></i>
      <span id="userTabLabel">User Login</span>
    </div>
  </div>

  <script>
 

    function selectStarTab(tabNumber) {
      const starTabs = document.querySelectorAll(".nav-tab[data-tab]");
      starTabs.forEach((tab) => {
        const isSelected = tab.dataset.tab == tabNumber;
        tab.classList.toggle("active", isSelected);
        tab.setAttribute("aria-selected", isSelected);
        tab.tabIndex = isSelected ? 0 : -1;
      });
    }

    function messagesStarTab() {
      window.location.href = "messaging.html";
    }
        function settingsStarTab() {
      window.location.href = "settings.html";
    }
        function reccomendationsStarTab() {
      window.location.href = "recommendationpage.html";
    }

    function connectionsStarTab() {
      const mentor = localStorage.getItem("loggedInMentor");
      window.location.href = "connections.html";
    }

    function calendarsStarTab() {
      window.location.href = "calendar.html";
    }

    function mentorTabClick() {
      const mentor = localStorage.getItem("loggedInMentor");
      window.location.href = mentor ? "profile.html" : "login mentor.php";
    }

    function userTabClick() {
      const user = localStorage.getItem("loggedInUser");
      user ? logoutUser() : window.location.href = "login.php";
    }

    function logoutUser() {
      localStorage.removeItem("loggedInUser");
      localStorage.removeItem("loggedInMentor");
      updateTabs();
    }

    function logoutMentor() {
      localStorage.removeItem("loggedInMentor");
      localStorage.removeItem("loggedInUser");
      updateTabs();
    }

    function updateTabs() {
      const loggedInUser = localStorage.getItem("loggedInUser");
      const loggedInMentor = localStorage.getItem("loggedInMentor");

      const mentorTab = document.getElementById("mentorTab");
      const mentorLabel = document.getElementById("mentorTabLabel");

      const userTab = document.getElementById("userTab");
      const userLabel = document.getElementById("userTabLabel");

      const tabIds = ["tabMessages", "tabCalendar", "tabRecs", "tabConnections", "tabSettings"];
      const showTabs = loggedInUser || loggedInMentor;

      tabIds.forEach(id => {
        document.getElementById(id).classList.toggle("hidden", !showTabs);
      });

      if (loggedInUser && !loggedInMentor) {
        mentorLabel.textContent = "User Profile";
        mentorTab.querySelector("i").className = "fas fa-user";
        mentorTab.onclick = () => window.location.href = "profile.html";

        userLabel.textContent = "Logout";
        userTab.querySelector("i").className = "fas fa-sign-out-alt";
        userTab.onclick = logoutUser;

      } else if (loggedInMentor && !loggedInUser) {
        mentorLabel.textContent = "Mentor Profile";
        mentorTab.querySelector("i").className = "fas fa-user-tie";
        mentorTab.onclick = () => window.location.href = "profile.html";

        userLabel.textContent = "Logout";
        userTab.querySelector("i").className = "fas fa-sign-out-alt";
        userTab.onclick = logoutMentor;

      } else {
        mentorLabel.textContent = "Mentor Login";
        mentorTab.querySelector("i").className = "fas fa-user-tie";
        mentorTab.onclick = mentorTabClick;

        userLabel.textContent = "User Login";
        userTab.querySelector("i").className = "fas fa-user";
        userTab.onclick = userTabClick;
      }
    }

    document.addEventListener("DOMContentLoaded", () => {
      updateTabs();
      const savedImage = localStorage.getItem("userProfileImage");
      document.getElementById("mainProfileImage").src = savedImage || "profile.png";

      // Universal theme check
      const theme = localStorage.getItem("theme");
      if (theme === "dark") {
        document.body.classList.add("dark-mode");
      }
    });
  </script>
</body>
</html>
