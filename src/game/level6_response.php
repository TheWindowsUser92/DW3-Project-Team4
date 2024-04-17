<head><link rel='stylesheet' href='levelStyle.css'><script src="../features/cancel.js"></script></head>
<?php
if (isset($_POST['submit'])) {
    $smallest = $_POST['smallAns'];
    $largest = $_POST['largeAns'];
    $userSmallest = $_POST['smallest'];
    $userLargest = $_POST['largest'];

    // Game logic to determine outcome
    if ($userSmallest == $smallest && $userLargest == $largest) {
        header("Location: Win.php");
        exit;
    } else {
        header("Location: GameOver.php");
        exit;
    }
}