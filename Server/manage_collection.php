<?php
/**
 * File: manage_collection.php
 * Description: Displays the user's movie collection and allows searching for movies.
 * Redirects to login if user is not authenticated.
 */

session_start(); // Start session
require_once "db_connect.php"; // Include DB connection

// Redirect to login page if not logged in
if (!isset($_SESSION["user_id"])) {
    header("Location: ../Html/login.html");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Manage My Collection</title>

    <!-- Main stylesheet -->
    <link rel="stylesheet" href="../Styles/style.css">
</head>

<body>
    <!-- Hidden page content, shown only after JS image load check -->
    <div id="page-content" style="display: none;">
        <!-- Header with navigation -->
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

        <!-- Main content -->
        <main class="collection-main">

            <!-- Section showing current user's collection -->
            <section class="collection-section">
                <header>
                    <h2>Your Movie Collection</h2>
                </header>
                <ul id="collectionList"></ul>
                <!-- Message when collection is empty -->
                <p id="emptyMessage" style="display:none;">You haven’t added any movies yet.</p>
            </section>

            <hr>

            <!-- Section to search all movies -->
            <section class="search-section">
                <header>
                    <h2>Search All Movies</h2>
                </header>

                <!-- Search input form -->
                <form id="searchForm" aria-label="Search Movies Form">
                    <input type="text" id="searchInput" placeholder="Search by title, genre, mood..." required>
                </form>

                <!-- Dynamic section for displaying search results -->
                <section class="search-results">
                    <header id="searchResultsHeader" style="display: none;">
                        <h3>Search Results:</h3>
                    </header>
                    <ul id="searchResults"></ul>
                    <!-- Message if no results found -->
                    <p id="noResultsMessage" style="display: none;">No matching movies found.</p>
                </section>
            </section>

        </main>
    </div>

    <!-- JS: Logic for fetching, displaying, and modifying collection -->
    <script src="../Js/collection.js" defer></script>
</body>

</html>
