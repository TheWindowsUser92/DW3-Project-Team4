<?php
require_once '../../db/Database.php'; // Adjust the path as necessary
require_once '../../db/Select.php';    // Adjust the path as necessary
require_once '../../config.php';       
session_start();

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    $errorMessages = [];

    // Instantiate Select class with the action key for fetching registration order
    $select = new Select('selectKey', $username);

    // Attempt to fetch user's registration order
    $result = $select->selectFromTAB();

    // Debug: See the structure of the result
    // print_r($result); // Uncomment for debugging
    
    // Correctly extract registration order from result
    if (!empty($result) && isset($result['row1']['registrationOrder'])) {
        $registrationOrder = $result['row1']['registrationOrder'];
    } else {
        $_SESSION['signin-errorMessages'] = "An unexpected error occurred. Please try again.";
        header('Location: ../../public/form/signin-form.php');
        exit;
    }

    // Instantiate Select class with the action key for fetching password using the registration order
    $selectPass = new Select('selectCode', $username , $registrationOrder);
    $resultPass = $selectPass->selectFromTAB();

    // Debug: See the structure of the result
    //print_r($resultPass); // Uncomment for debugging

    // Assuming resultPass structure is similar, correctly extract passCode from result
    if (!empty($resultPass) && isset($resultPass['row1']['passCode'])) {
        $hashedPassword = $resultPass['row1']['passCode'];
    } else {
        $_SESSION['signin-errorMessages'] = "Password record not found.";
        header('Location: ../../public/form/signin-form.php');
        exit;
    }

    // Verify the password
    if (password_verify($password, $hashedPassword)) {
        // If the password is correct, set the session variable and redirect to the game page
        $_SESSION['username'] = $username;
        $_SESSION['signin-errorMessages'] = $errorMessages;
        header('Location: ../../index.php');
        exit;
    } else {
        // If the password is incorrect, set an error message
        $_SESSION['error'] = "Sorry, the username or password is incorrect!";
        $_SESSION['signin-errorMessages'] = $errorMessages;
        header('Location: ../../public/form/signin-form.php');
        exit;

    }
}
