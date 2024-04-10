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
		
		<?php if (isset($_SESSION['signin-errorMessages'])): ?>
    		<div style="color: red;">
        	<?php 
			try 
        	{
				echo htmlspecialchars($_SESSION['signin-errorMessages']);
        		unset($_SESSION['signin-errorMessages']); // Clear the error message after displaying it
			}
			catch(e)
			{
				echo "<button type=\"button\" onclick=\"location.href='../../src/features/signout.php';\">Sign out</button>";
			}
        ?>
    		</div>
			<?php endif; 
		?>

		<label for="username">Username:</label>
		<input type="text" id="username" name = "username"><br>

		<label for="password">Password:</label>
		<input type="password" id="password" name = "password"><br>

		<button type ="submit">Login</button>
        <button type="button" onclick="location.href='signup-form.php';">Register</button>

		<p><a href="../../src/functions/changingPasswordOfExistingUser.php">Forgot your password? Change it</a></p>


		
	</form>

</body>
</html>