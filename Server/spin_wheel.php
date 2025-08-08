<?php
/**
 * File: spin_wheel.php
 * Description: Handles the spinning of the movie wheel and returns a random movie.
 * Requires user to be authenticated.
 * Responds to an AJAX request from spin.js by returning one random movie in JSON format — assuming the user is logged in.
 */

require_once '../Server/db_connect.php'; // Include DB connection
session_start(); // Start session

header('Content-Type: application/json'); // Set response type to JSON

// Check if user is authenticated
if (!isset($_SESSION["user_id"])) {
    http_response_code(403); // Set HTTP status to 403 Forbidden
    echo json_encode(["error" => "Unauthorized"]); // Return error as JSON
    exit;
}

// Prepare SQL query to fetch all movie data
$stmt = $conn->prepare("SELECT title, genre, mood, runtime, poster_url FROM movies");
$stmt->execute();
$result = $stmt->get_result();

// Fetch all movies as an array of associative arrays
$movies = $result->fetch_all(MYSQLI_ASSOC);

// If movies exist, pick a random one
if ($movies) {
    $selected = $movies[array_rand($movies)];

    // Return selected movie details as JSON to spin.js
    echo json_encode([
        "title" => $selected["title"],
        "genre" => $selected["genre"],
        "mood" => $selected["mood"],
        "runtime" => $selected["runtime"],
        "poster_url" => $selected["poster_url"]
    ]);
} else {
    // If no movies found, return error JSON to spin.js
    echo json_encode(["error" => "No movies found"]); 
}
exit;
