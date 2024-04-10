<?php
include "databaseConnection.php";
class DatabaseOperations {
    private $db;

    public function __construct(dbh $db) {
        $this->db = $db;
    }

    // Method to initialize the database
   // Method to initialize the database
public function initializeDatabase() {
    $this->db->createDatabase(); //Creates a Database if it's not already created
    $conn = $this->db->getConnection();

    // Execute SQL TABLES IF NOT ALREADY CREATED
    $sql_queries = array(
        "CREATE TABLE IF NOT EXISTS players (
            fName VARCHAR(50) NOT NULL, 
            lName VARCHAR(50) NOT NULL, 
            userName VARCHAR(20) NOT NULL UNIQUE,
            registrationTime DATETIME NOT NULL,
            id VARCHAR(200) GENERATED ALWAYS AS (CONCAT(UPPER(LEFT(fName,2)),UPPER(LEFT(lName,2)),UPPER(LEFT(userName,3)),CAST(registrationTime AS SIGNED))),
            registrationOrder INTEGER AUTO_INCREMENT,
            PRIMARY KEY (registrationOrder)
        )CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci", 
    
        "CREATE TABLE IF NOT EXISTS authenticator(   
            passCode VARCHAR(255) NOT NULL,
            registrationOrder INTEGER, 
            FOREIGN KEY (registrationOrder) REFERENCES players(registrationOrder)
        )CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci", 
    
        "CREATE TABLE IF NOT EXISTS score( 
            scoreTime DATETIME NOT NULL, 
            result ENUM('win', 'gameover', 'incomplete'),
            livesUsed INTEGER NOT NULL,
            registrationOrder INTEGER, 
            FOREIGN KEY (registrationOrder) REFERENCES players(registrationOrder)
        )CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci"
    );

    foreach ($sql_queries as $query) {
        if ($conn->query($query) === TRUE) {
            echo "<br>Query executed successfully<br>";
        } else {
            echo "Error executing query: " . $conn->error;
        }
    }

    // Check if history view already exists
    $check_view_query = "SHOW TABLES LIKE 'history'";
    $view_exists = $conn->query($check_view_query);

    if ($view_exists->num_rows == 0) {
        // Create the history view if it doesn't exist
        $create_view_query = "CREATE VIEW history AS
            SELECT s.scoreTime, p.id, p.fName, p.lName, s.result, s.livesUsed 
            FROM players p, score s
            WHERE p.registrationOrder = s.registrationOrder";
        
        if ($conn->query($create_view_query) === TRUE) {
            echo "<br>History view created successfully<br>";
        } else {
            echo "Error creating history view: " . $conn->error;
        }
    } else {
        echo "<br>History view already exists<br><br>";
    }

    $conn->close();
}


    // Method to process login
    public function login($username, $password) {
        // Sanitize inputs
        $username = $this->sanitizeInput($username);
        $password = $this->sanitizeInput($password);

        $conn = $this->db->getConnection();

        // Retrieve hashed password from the database
        $stmt = $conn->prepare("SELECT password FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->bind_result($hashed_password);
        $stmt->fetch();

        if (password_verify($password, $hashed_password)) {
            echo "Login successful<br><br>";
        } else {
            echo "Invalid username or password";
        }

        $stmt->close();
        $conn->close();
    }

    // Method to sanitize input
    private function sanitizeInput($input) {
        return htmlentities(strip_tags(stripslashes($input))); //built in functions
    } 

    // Method to insert user securely
    public function insertUser($username, $password) {
        // Sanitize inputs
        $username = $this->sanitizeInput($username);
        $password = $this->sanitizeInput($password);

        $conn = $this->db->getConnection();
        // Hash the password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT); //Pass Hash, PASSWORD_DEFAULT is a constant default algorithm for pass_hash

        // Prepare insert statement
        $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
        $stmt->bind_param("ss", $username, $hashed_password);

        // Execute the statement
        if ($stmt->execute() === TRUE) {
            echo "New record inserted successfully";
        } else {
            echo "Error: " . $stmt->error;
        }

        // Close the statement and connection
        $stmt->close();
        $conn->close();
    }
}

// Initialize database connection
$db = new dbh();

// Initialize database operations
$dbOperations = new DatabaseOperations($db);

// Call the function to initialize database
$dbOperations->initializeDatabase();

// Assuming registration form data is submitted via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $dbOperations->login($username, $password);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Database</title>
</head>
<body>
<form method="post" action="databaseOperations.php">
    Username: <input type="text" name="username"><br>
    Password: <input type="password" name="password"><br>
    <input type="submit" value="Submit">
</form>

</body>
</html>