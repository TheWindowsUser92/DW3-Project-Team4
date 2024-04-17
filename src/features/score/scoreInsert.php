<?php

require_once '../../db/Database.php'; // Adjust the path as necessary
require_once '../../db/Insert.php';    // Adjust the path as necessary
require_once '../../config.php'; 

function scoreInsert($result)
{
    $database = new Database();
    $conn = $database->getConnection();

    $scoreTime = date('Y-m-d H:i:s'); // Current timestamp
    $livesUsed = 0;
    $registrationOrder = $_SESSION['registrationOrder'];

    $scoreToInsert = new Insert('insertGameScore', '', '', '', '', '', $registrationOrder, $scoreTime, $result, $livesUsed);

}
