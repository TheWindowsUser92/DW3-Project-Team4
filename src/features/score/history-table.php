<style>
    /* Styles for the history table */
    .history-table {
        width: 100%;
        border-collapse: collapse;
    }

    .history-table th,
    .history-table td {
        padding: 8px;
        border: 1px solid #ddd;
    }

    /* Header styles */
    .history-table th {
        background-color: #4CAF50; /* Green */
        color: white;
        text-align: left;
    }

    /* Row styles */
    .history-table tr:nth-child(even) {
        background-color: #f2f2f2; /* Light gray */
    }

    /* Hover effect */
    .history-table tr:hover {
        background-color: #ddd; /* Gray */
    }
</style>
<?php

require_once '../../../db/Database.php'; // Adjust the path as necessary
require_once '../../../config.php';


// Instantiate Database class
$database = new Database();
$conn = $database->getConnection();

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Define your SQL query to select data from the history view
$sql = "SELECT * FROM history";

// Execute the query
$result = $conn->query($sql);

// Check if the query was successful
if ($result) {
    echo "<h1>Game History</h1>";
    // Check if there are any rows returned
    if ($result->num_rows > 0) {
        // Output a table
        echo "<table class='history-table' border='1'>";
        echo "<tr><th>Score Time</th><th>ID</th><th>First Name</th><th>Last Name</th><th>Result</th><th>Lives Used</th></tr>";
        
        // Output data of each row
        while ($row = $result->fetch_assoc()) {
            // Output a row
            echo "<tr>";
            echo "<td>" . $row["scoreTime"] . "</td>";
            echo "<td>" . $row["id"] . "</td>";
            echo "<td>" . $row["fName"] . "</td>";
            echo "<td>" . $row["lName"] . "</td>";
            echo "<td>" . $row["result"] . "</td>";
            echo "<td>" . $row["livesUsed"] . "</td>";
            echo "</tr>";
        }
        
        echo "</table>";
    } else {
        echo "No results found";
    }
} else {
    echo "Error: " . $conn->error;
}

// Close the connection
$conn->close();
?>
