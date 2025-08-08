<?php
/**
 * File: main_menu.php
 * Description: Displays the main menu for authenticated user.
 * Redirects to login if user is not authenticated.
 */

// Start the session to access session variables
session_start();
require_once "db_connect.php"; // Include DB connection

// Redirect user to login if not authenticated
if (!isset($_SESSION["user_id"])) {
    header("Location: login.html");
    exit;
}

// Store user ID from session
$user_id = $_SESSION["user_id"];

// Load user info from DB
$res = $conn->query("SELECT * FROM users WHERE id = $user_id");
// If the query was successful, fetch user data as an associative array; otherwise set $user to null
$user = $res ? $res->fetch_assoc() : null;
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Main Menu</title>

  <!-- Main stylesheet -->
  <link rel="stylesheet" href="../Styles/style.css">
</head>

<body>
  <!-- Top navigation menu -->
  <header>
    <nav class="main-nav" aria-label="Main Navigation">
      <ul>
        <li><a href="../Server/manage_collection.php" class="cta-btn">🎬 Your Collection</a></li>
        <li><a href="../Server/watch.php" class="cta-btn">🎲 Watch a Movie</a></li>
        <li><a href="../Server/main_menu.php" class="cta-btn">📋 Main Menu</a></li>
        <li><a href="../Server/logout.php" class="cta-btn">🚪 Logout</a></li>
      </ul>
    </nav>
  </header>

  <!-- Hero banner section -->
  <section class="hero">
    <img src="../Images/hero.jpg" alt="Hero Image" class="hero-bg">
    <div class="hero-text">🍿 Discover Your Next Movie Night</div>
  </section>

  <!-- Main content section -->
  <main class="main-menu">
    <section class="menu-content">
      <!-- Personalized welcome using username from DB -->
      <header>
        <h1>Welcome Back, <?= strtoupper(htmlspecialchars($user["username"])) ?></h1>
      </header>

      <h3>What would you like to do?</h3>

      <!-- Navigation buttons -->
      <div class="menu-buttons">
        <a href="watch.php">
          <button type="button">🎬 Watch a Movie</button>
        </a>
        <a href="../Server/manage_collection.php">
          <button type="button">📚 Manage My Collection</button>
        </a>
      </div>
    </section>
  </main>
</body>
</html>
