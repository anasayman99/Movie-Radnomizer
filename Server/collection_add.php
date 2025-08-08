<?php
/**
 * File: collection_add.php
 * Description: Handles adding a movie to the user's collection.
 * Redirects to manage_collection.php after successful addition. 
*/

// Start the session to access user session data
session_start();

// Include database connection
require_once "db_connect.php";

// Redirect to login if user is not authenticated or no movie ID provided
if (!isset($_SESSION["user_id"]) || !isset($_POST["movie_id"])) {
    header("Location: ../Html/login.html");
    exit;
}

// Retrieve user ID and movie ID from session and form
$user_id = $_SESSION["user_id"];
$movie_id = $_POST["movie_id"];

// Check if the selected movie is already in the user's collection
$sql = "SELECT 1 FROM collections WHERE user_id = $user_id AND movie_id = $movie_id";
$result = $conn->query($sql);

// If it exists, skip duplicate insert and redirect back
if ($result && $result->num_rows > 0) {
    header("Location: ../Html/manage_collection.php");
    exit;
}

// Insert new entry into the user's collection with the current timestamp
$sql = "INSERT INTO collections (user_id, movie_id, added_on) VALUES ($user_id, $movie_id, NOW())";
$conn->query($sql);

// Redirect back to collection page after insertion
header("Location: ../Server/manage_collection.php");
exit;
?>
