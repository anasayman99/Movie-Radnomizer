<?php
/**
 * File: register.php
 * Description: Handles user registration by validating input, checking for duplicates,
 * inserting new user into the database, and returning a JSON response indicating success or failure for use in register.js.
 */

// Set response type to JSON
header('Content-Type: application/json');

require_once "db_connect.php"; // Include DB connection

// Ensure request method is POST
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    echo json_encode([
        "success" => false,
        "message" => "❌ Invalid request method."
    ]);
    exit;
}

// Collect form data from POST request
$username = $_POST["username"] ?? '';
$email = $_POST["email"] ?? '';
$password = $_POST["password"] ?? '';
$genre = $_POST["genre"] ?? '';
$mood = $_POST["mood"] ?? '';
$min_runtime = $_POST["min_runtime"] ?? 0;
$max_runtime = $_POST["max_runtime"] ?? 0;


// Check for duplicate username
$res1 = $conn->query("SELECT id FROM users WHERE username = '$username'");
if ($res1 && $res1->num_rows > 0) {
    echo json_encode([ // Json response for register.js
        "success" => false,
        "field" => "username",
        "message" => "❌ Username already exists."
    ]);
    exit;
}

// Check for duplicate email
$res2 = $conn->query("SELECT id FROM users WHERE email = '$email'");
if ($res2 && $res2->num_rows > 0) { 
    echo json_encode([ // Json response for register.js
        "success" => false,
        "field" => "email",
        "message" => "❌ Email already exists."
    ]);
    exit;
}

// Hash password securely
$password_hash = password_hash($password, PASSWORD_DEFAULT);

// Insert new user into the database
$sql = "INSERT INTO users (username, email, password_hash, genre, mood, min_runtime, max_runtime)
        VALUES ('$username', '$email', '$password_hash', '$genre', '$mood', $min_runtime, $max_runtime)";
$conn->query($sql);

// Respond with success and redirect URL
echo json_encode([ // Json success response for register.js
    "success" => true,
    "redirect" => "../Html/login.html"
]);
exit;
?>
