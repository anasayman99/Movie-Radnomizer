<?php
/**
 * File: collection_get.php
 * Description: Fetches the user's movie collection from the database.
 * Returns a JSON array of movies in the user's collection for use in collection.js.
 */

session_start(); // Start session to access user ID
require_once "db_connect.php"; // Include database connection

// Reject request if user is not authenticated
if (!isset($_SESSION["user_id"])) {
    http_response_code(401); // Unauthorized
    echo json_encode(["error" => "Unauthorized"]); //json response for collection.js
    exit;
}

// Store user ID from session
$user_id = $_SESSION["user_id"];

// SQL query to fetch all movies in the user's collection
$sql = "SELECT m.id, m.title, m.genre, m.mood, m.runtime, m.poster_url
        FROM movies m
        JOIN collections c ON m.id = c.movie_id
        WHERE c.user_id = $user_id";

// Execute query
$res = $conn->query($sql);

// Collect movie data into array
$movies = [];
while ($row = $res->fetch_assoc()) {
    $movies[] = $row;
}

// Return movie data as JSON for collection.js
header('Content-Type: application/json');
echo json_encode($movies);
?>
