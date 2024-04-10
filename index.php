<?php session_start() ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Placeholder game</title>
    <!-- Additional meta tags, CSS links, or scripts can be included here -->
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Placeholder game</h1>
        <!-- Other header content can go here, like a logo or navigation -->
        <nav>
            <ul>
                <li><a id="navplay"href="#">Play</a></li>
                <li><a href="#">Game History</a></li>
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
        <p>This is the main content of the website.</p>
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
