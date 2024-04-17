<head><link rel='stylesheet' href='levelStyle.css'><script src="../features/cancel.js"></script></head>
<?php
if (isset($_POST['submit'])) {
    // Process the submitted result here
    $userResults = $_POST['result'];

    // Game logic to determine outcome
    $correct = false;
    if ($userResults == $_POST['answer']) { // Compare with sorted random numbers
        $correct = true;
    }

    if ($correct) {
        echo "<div class=\"container\">";
        echo "<h1>Congratulations!</h1>";
        echo "<button onclick=\"window.location.href = 'Level5.php';\">Next Level</button>";
        echo "<button onclick=\"confirmQuit()\">Cancel</button></div>";
    } else {
        header("Location: GameOver.php");
        exit;
    }
}