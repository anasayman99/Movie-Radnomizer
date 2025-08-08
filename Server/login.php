<?php
/**
 * File: login.php
 * Description: Handles user login by verifying credentials and starting a session.
 * Returns JSON response indicating success or failure of login attempt for use in login.js.
 */

session_start(); // Start session for storing user ID
require_once "db_connect.php"; // Include DB connection

header('Content-Type: application/json'); // Return JSON response

// Reject non-POST requests
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    http_response_code(405); // Method Not Allowed
    echo json_encode(["success" => false, "message" => "Invalid request."]);
    exit;
}

// Sanitize and normalize user input
// Use strtolower to handle case-insensitive usernames
// Trim whitespace to avoid issues with leading/trailing spaces
// If username or password or empty, use null and return error
$username = strtolower(trim($_POST["username"] ?? ''));
$password = $_POST["password"] ?? '';

// Validate input presence 
if ($username === '' || $password === '') {
    echo json_encode(["success" => false, "message" => "All fields are required."]); //json response for login.js
    exit;
}

// SQL query to fetch user by normalized username
$sql = "SELECT id, password_hash FROM users WHERE LOWER(username) = '$username'";
$result = $conn->query($sql);

// If no user found with that username
if ($result->num_rows === 0) {
    echo json_encode(["success" => false, "message" => "Wrong username or password."]); //json response for login.js
    exit;
}

// Fetch user data as an associative array
$user = $result->fetch_assoc();

// Verify password against stored hash
if (!password_verify($password, $user["password_hash"])) {
    echo json_encode(["success" => false, "message" => "Wrong username or password."]); //json response for login.js
    exit;
}

// Store user ID in session and return success response for login.js
$_SESSION["user_id"] = $user["id"];
echo json_encode(["success" => true]);
exit;
?>
