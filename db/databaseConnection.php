<?php
class dbh {
    private $servername;
    private $username;
    private $password;
    private $dbname;

    public function connect() {
        $this->servername = "localhost";
        $this->username = "root";
        $this->password = ""; //CHANGE TO YOUR PASSWORD, I already has mysqladmin with this pass
        $this->dbname = "kidsGames";

        // Attempt to establish the database connection
        $conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);

        // Check if there's an error during the connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // If no error, return the connection object
        return $conn;
    }

    public function createDatabase() {
        $conn = $this->connect();
        $sql = "CREATE DATABASE IF NOT EXISTS $this->dbname";
        if ($conn->query($sql) === TRUE) {
            echo "<br>"."Database created successfully<br>";
        } else {
            echo "Error creating database: " . $conn->error;
        }
        $conn->close();
    }

    public function getConnection() {
        $conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        return $conn;
    }
}

// Create an instance of the dbh class
$database = new dbh();

// Call the connect method
$connection = $database->connect();

// Check if the connection is successful
if ($connection) {
    //echo "Connected successfully<br>"; // This message will be displayed if the connection is successful
}
?>
