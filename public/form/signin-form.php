<?php
session_start()
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="../assets/css/style.css">
	<title>Sign In</title>

</head>
<body>


	<form id="signinForm" method="post" action="../../src/features/signin.php">
		<h2>Sign In</h2>
		
		<?php

            if (isset($_SESSION['signin-errorMessages'])) {
                echo "<div style='color: red;'>";
				foreach ($_SESSION['signin-errorMessages'] as $message) {
					echo ($message) . '<br>';
				}
                echo "</div>";
            	// Clear the error messages from session after displaying them
                unset($_SESSION['signin-errorMessages']);
            }
            ?>
    		</div> 

		<label for="username">Username:</label>
		<input type="text" id="username" name = "username"><br>

		<label for="password">Password:</label>
		<input type="password" id="password" name = "password"><br>

		<button type ="submit">Login</button>
        <button type="button" onclick="location.href='signup-form.php';">Register</button>

		<p>Forgot your password? <a href="../../src/functions/changingPasswordOfExistingUser.php">Change it</a></p>

		<a href="../../index.php">Go Home</a>
		
	</form>

</body>
</html>