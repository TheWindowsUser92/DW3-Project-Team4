<head><link rel='stylesheet' href='levelStyle.css'><script src="../features/cancel.js"></script></head>
<?php
if (isset($_POST['submit'])) {
    $smallest = $_POST['smallAns'];
    $largest = $_POST['largeAns'];
    $userSmallest = $_POST['smallest'];
    $userLargest = $_POST['largest'];

    // Game logic to determine outcome
    if ($userSmallest == $smallest && $userLargest == $largest) {
        echo "<div class=\"container\">";
        echo "<h1>Congratulations!</h1>";
        echo "<button onclick=\"window.location.href = 'Level6.php';\">Next Level</button>";
        echo "<button onclick=\"confirmQuit()\">Cancel</button></div>";
    } else {
        header("Location: GameOver.php");
        exit;
    }
}