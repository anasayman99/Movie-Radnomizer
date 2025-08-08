<?php
/**
 * File: search_movies.php
 * Description: Handles searching for movies based on user input.
 * Returns JSON response with search results.
 */

session_start(); // Start session
require_once "db_connect.php"; // Include DB connection

// Store user ID from session
$user_id = $_SESSION["user_id"];

// Get search query from URL parameter and sanitize it
$search_query = $conn->real_escape_string($_GET["search"] ?? '');

// Prepare SQL to search movies by title, genre, or mood
$sql = "SELECT * FROM movies 
        WHERE title LIKE '%$search_query%' OR genre LIKE '%$search_query%' OR mood LIKE '%$search_query%'";
$res = $conn->query($sql);

// Initialize arrays to store results
$results = [];
$owned = [];

// Get IDs of movies already in user's collection
$check = $conn->query("SELECT movie_id FROM collections WHERE user_id = $user_id");
if ($check) {
    // Store owned movie IDs in an associative array
    while ($r = $check->fetch_assoc()) {
        $owned[] = $r["movie_id"];
    }
}

// Process movie search results
if ($res) {
    while ($row = $res->fetch_assoc()) {
        // Flag whether movie is already in the user's collection
        $row["in_collection"] = in_array($row["id"], $owned);
        $results[] = $row;
    }
}

// Return results as JSON
header("Content-Type: application/json");
echo json_encode($results); // json response for collection.js
