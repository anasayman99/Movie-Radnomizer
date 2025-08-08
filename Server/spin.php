<?php
/**
 * File: spin.php
 * Description: Displays the spinning wheel interface for selecting a movie.
 * Requires user to be authenticated.
 */

session_start(); // Start session

// Redirect to login page if user is not authenticated
if (!isset($_SESSION["user_id"])) {
    header("Location: ../Html/login.html");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Spin the Wheel</title>
    <!-- Link to main and spin stylesheets -->
    <link rel="stylesheet" href="../Styles/style.css">
    <link rel="stylesheet" href="../Styles/spin.css">
</head>

<body>
    <!-- Navigation menu -->
    <nav class="main-nav" aria-label="Main Navigation">
        <ul>
            <li><a href="manage_collection.php" class="cta-btn">🎬 Your Collection</a></li>
            <li><a href="watch.php" class="cta-btn">🎲 Watch a Movie</a></li>
            <li><a href="main_menu.php" class="cta-btn">📋 Main Menu</a></li>
            <li><a href="logout.php" class="cta-btn">🚪 Logout</a></li>
        </ul>
    </nav>

    <!-- Container for the spinning wheel and result -->
    <div class="wheel-container">
        <!-- The spinning wheel image -->
        <div class="wheel" id="wheel">
            <img src="../Images/Wheel.png" class="wheel-image" alt="Spin Wheel">
        </div>

        <!-- Spin and back buttons -->
        <div class="spin-button-container">
            <button type="button" class="red-button" id="spinBtn">🎯 Spin Now</button>
            <a href="watch.php" class="red-button">⬅️ Back to Watch Page</a>
        </div>

        <!-- Placeholder for selected movie details (populated dynamically by JS) -->
        <div class="movie-card" id="movieCard">
            <!-- Movie title -->
            <div class="movie-title-row">
                <span class="icon">🎬</span>
                <h2 id="title"></h2>
            </div>

            <!-- Movie poster -->
            <img id="poster" class="movie-poster" src="" alt="Movie Poster">

            <!-- Movie genre -->
            <div class="movie-detail-row">
                <span class="icon">🎭</span>
                <span class="label">Genre:</span>
                <span class="value" id="genre"></span>
            </div>

            <!-- Movie mood -->
            <div class="movie-detail-row">
                <span class="icon">🧠</span>
                <span class="label">Mood:</span>
                <span class="value" id="mood"></span>
            </div>

            <!-- Movie runtime -->
            <div class="movie-detail-row">
                <span class="icon">⏱️</span>
                <span class="label">Runtime:</span>
                <span class="value" id="runtime"></span>
            </div>
        </div>
    </div>

    <!-- Link to JavaScript file handling the spin logic -->
    <script src="../Js/spin.js" defer></script>
</body>

</html>
