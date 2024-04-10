<?php

class DatabaseUse extends dbh{

 protected function getAllUsers(){

    $sql = "SELECT * FROM player";
    $result = $this -> connect() ->query($sql);
    if ($result === false) {
        die("Error executing SQL query: " . $this->connect()->error);
    }

    $numRows = $result->num_rows;
    if($numRows > 0)
    {
        while($row = $result->fetch_assoc())
        {
            $data[] = $row;
        }
        return $data;
    }
 }
}


   