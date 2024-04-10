<?php

class ViewUser extends DatabaseUse{

 public function showAllUsers(){
    $datas = $this->getAllUsers();
    foreach($datas as $data)
    {
        echo $data['fName']."<br>";
        echo $data["lName"]."<br>";
        echo $data["userName"]."<br>";
        echo $data["registrationTime"]."<br>";
        echo $data["id"]."<br>";
        echo $data["registrationOrder"];
    }
 }
}
