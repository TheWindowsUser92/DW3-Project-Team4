<?php
session_start();

// Here, you would add logic to save any incomplete game session to the database.
// This is a placeholder for where you would implement that logic.

// Destroy the session.
session_destroy();

// Redirect to the homepage.
header('Location: ../../index.php');
exit();