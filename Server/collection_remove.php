<?php
/**
 * File: collection_remove.php
 * Description: Handles removing a movie from the user's collection.
 * Redirects to manage_collection.php after successful removal.
 */

// Start the session to access user data
session_start();

// Include database connection
require_once "db_connect.php";

// If user is not logged in or movie ID not provided, redirect to login page
if (!isset($_SESSION["user_id"]) || !isset($_POST["movie_id"])) {
    header("Location: ../Html/login.html");
    exit;
}

// Retrieve user ID from session and movie ID from POST
$user_id = $_SESSION["user_id"];
$movie_id = $_POST["movie_id"];

// Build SQL to delete this specific movie from the user's collection
$sql = "DELETE FROM collections WHERE user_id = $user_id AND movie_id = $movie_id";

// Execute the SQL delete command
$conn->query($sql);

// Redirect back to the collection management page after deletion
header("Location: ../Server/manage_collection.php");
exit;
?>
