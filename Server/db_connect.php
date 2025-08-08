<?php   
/**
 * File: db_connect.php
 * Description: Establishes a connection to the MySQL database.
 * This file is included in other PHP scripts to reuse the database connection.
 */

// Database connection (reuse in all PHP files)

// DB server hostname (localhost for XAMPP)
$host = "localhost";

// MySQL username
$user = "root";

// MySQL password (empty by default in XAMPP)
$password = "";

// Database name used in the project
$database = "movie_app"; // Replace with your actual DB name if different

// Create a new connection to MySQL
$conn = new mysqli($host, $user, $password, $database);

// Check for connection errors
if ($conn->connect_error) {
    // Terminate the script and print error if connection fails
    die("❌ Database connection failed: " . $conn->connect_error);
}
?>
