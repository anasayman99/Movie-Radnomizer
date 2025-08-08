<?php
/**
 * File: logout.php
 * Description: Handles user logout by destroying the session.
 * Redirects to the login page after logging out.
 */

// Start the session to access session data
session_start();

// Destroy all session data (log the user out)
session_destroy();

// Redirect the user to the login page
header("Location: ../Html/login.html");

// Stop script execution immediately after redirect
exit;
