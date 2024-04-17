<?php session_start() ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kids game</title>
    <!-- Additional meta tags, CSS links, or scripts can be included here -->
    <link rel="stylesheet" href="styles.css">
    <script>
        function changeFrame(src) {
            document.getElementById('content-frame').src = src;
        }
    </script>
</head>
<body>
    <header>
        <h1>Kids game</h1>
        <!-- Other header content can go here, like a logo or navigation -->
        <nav>
            <ul>
                <li><a id="navplay" href="#" onclick="changeFrame('./src/game/StartTheGame.php')">Play</a></li>
                <li><a href="#" onclick="changeFrame('./src/features/score/history-table.php')">Game History</a></li>
                <li class="userlog">
                <?php
                    echo "<a href=\"";
                    if (!isset($_SESSION['username'])){
                        //Redirect to the login form
                        //header('Location: signin-form.php'); 
                        echo './public/form/signin-form.php">Sign in</a></li>';
                    }
                    else {
                        //Redirect to the appropriate game form level
                        echo './src/features/signout.php">Sign out</a></li>';
                        echo "<li class=\"loggedin userlog\">Logged in as ".$_SESSION['username']."</li>";
                    } ?>
            </ul>
        </nav>
    </header>
    
    
    
    <main>
        <!-- Main content of the website goes here -->
        <?php
            if (!isset($_SESSION['username'])){
                echo "<div style=\"text-align: center\"><p>Please sign into your account in order to play the game or view the game history.</p>";
                echo "<button type=\"button\" class=\"btn\" onclick=\"window.location.href='./public/form/signin-form.php';\">Sign in</button></div>";
            }
            else {
                echo "<iframe id='content-frame' src=\"./src/game/StartTheGame.php\" frameborder=\"0\" width=\"90%\" height=\"500\"></iframe>";
            }
        ?>
    </main>
    
    <footer>
        <p>Brought to you by:</p>
        <ul>
            <li>Ali Bahiraei</li>
            <li>Dornaz Namazi</li>
            <li>Arshath Wuvais</li>
            <li>Junyi Shen</li>
            <li>Kooshal Aman Foolmaun</li>
        </ul>
    </footer>
</body>
</html>
