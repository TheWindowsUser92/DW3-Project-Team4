<?php
session_start();

// Define timeout duration (15 minutes converted to seconds)
$timeout_duration = 900;

// Automatic logout due to inactivity
// Check if the user is logged in
if (isset($_SESSION['username'])) {
    // Check if last activity time is set
    if (isset($_SESSION['last_activity'])) {
        // Calculate elapsed time since last activity
        $inactive_time = time() - $_SESSION['last_activity'];
        // Check if inactive time exceeds timeout threshold
        if ($inactive_time > $timeout_duration) {
            // Logic to save any incomplete game session here for timeout

            // Destroy the session to log out the user
            session_destroy();
            
            // Start a new session to pass a message
            session_start();
            $_SESSION['message'] = "You've been logged out due to inactivity.";

            // Redirect to the homepage or login page
            header('Location: index.php');
            exit();
        }
    }
    // Update last activity time
    $_SESSION['last_activity'] = time();
}
