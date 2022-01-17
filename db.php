<?php
 $localhost = "localhost";
 $database = "domaci1php";
 $username = "root";
 $password = "";

$conn = new mysqli($localhost,$username,$password,.$database);

if ($conn->connect_errno) {
    exit("Something wrong. Connection with database failed! " . $connection->connect_errno);
}


?>
