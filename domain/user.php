<?php
class User{

public $id;
public $name;
public $username;
public $password;

public function __construct($id=null, $name = null, $username=null,$password=null){
    $this->id = $id;
    $this->name = $name;
    $this->username = $username;
    $this->password=$password;

}

public static function userLogIn($username,$password,mysqli $conn){

    $sql = "SELECT * FROM user WHERE username='" . $username . "' AND password='" . $password . "' limit 1";
    return $conn->query($sql);


}


}


?>