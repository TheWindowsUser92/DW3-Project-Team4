<?php
include "databaseConnection.php";
include "gettingElementsFromPlayer.php";
include "viewPlayer.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title></title>
</head>
<body>
<h3>Table: Player</h3>
    <?php
    $users = new ViewUser();
    $allUsers = $users->showAllUsers();
    if (is_array($allUsers) && count($allUsers) > 0) {
        foreach($allUsers as $user)
        {
            echo "<tr>";
            echo "<td>" . $user['fName'] . "</td>";
            echo "<td>" . $user["lName"] . "</td>";
            echo "<td>" . $user["userName"] . "</td>";
            echo "<td>" . $user["registrationTime"] . "</td>";
            echo "<td>" . $user["registrationOrder"]. "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } 
    
    ?>
</body>
</html>