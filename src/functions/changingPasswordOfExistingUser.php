<?php
include "../../db/databaseConnection.php";

Class PasswordChange {
    private $db;

    public function __construct(dbh $db) {
        $this->db = $db;
    }

   // Function to change password
public function changePassword($username, $newPassword, $confirmPassword) {
    $conn = $this->db->getConnection();

    // Check if form fields are empty
    if (empty($username) || empty($newPassword) || empty($confirmPassword)) {
        return "<br>Please fill in all fields!";
    }

    // Check if new password matches the confirm password
    if ($newPassword !== $confirmPassword) {
        return "<br>Passwords do not match!";
    }

    // Hash the new password
    $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

    // Find the corresponding row in the authenticator table
    $sql = "SELECT * FROM authenticator WHERE registrationOrder = (SELECT registrationOrder FROM player WHERE userName = ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Update the passCode in the authenticator table
        $sql = "UPDATE authenticator SET passCode = ? WHERE registrationOrder = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $hashedPassword, $row['registrationOrder']);

        if ($stmt->execute()) {
            return "Password changed successfully!";
        } else {
            return "Error updating password: " . $conn->error;
        }
    } else {
        return "User not found!";
    }
}
}

// Create an instance of the dbh class
$database = new dbh();

// Call the connect method
$connection = $database->connect();

// Initialize password change object
$passwordChange = new PasswordChange($database);

// Checks if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $username = $_POST["username"];
    $newPassword = $_POST["newPassword"];
    $confirmPassword = $_POST["confirmPassword"];

    $result = $passwordChange->changePassword($username, $newPassword, $confirmPassword);
    //echo $result;

    // Check if the "Login" button was clicked
    if (isset($_POST['login'])) {
        header("Location: ../../public/form/signin-form.php");
        exit();
    }
}
?>

<!-- Basic form to see if working -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../public/assets/css/style.css">
    <title>Password Change</title>
</head>
<body>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <h2>Password Change Form</h2>
        Username: <input type="text" name="username"><br><br>
        New Password: <input type="password" name="newPassword"><br><br>
        Confirm Password: <input type="password" name="confirmPassword"><br><br>
        <span id="result" style="color:grey;"></span>
        <button type="submit" name="changePassword">Change Password</button>
        <button type="submit" name="login">Login</button>
    </form>
    <!-- JavaScript to update the result span -->
    <script>
        // Wait for the document to load
        document.addEventListener("DOMContentLoaded", function() {
            // Find the result span
            var resultSpan = document.getElementById("result");
            <?php if (isset($result)) : ?>
                // Update the content of the result span
                resultSpan.innerHTML = "<?php echo $result; ?>";
            <?php endif; ?>
        });
    </script>
</body>
</html>