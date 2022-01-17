<?php
require "db.php";
require "domain/user.php";


// pokretanje sesije
session_start();

if(isset($_GET['username']) && isset($_GET['password'])){

    $username = $_GET['username'];
    $password = $_GET['password'];
    echo "1";
    $result = User::userLogIn($username, $password, $conn);

    if($result->num_rows==1) {
        echo "Login successful";
        $_SESSION['user_id'] = $result->fetch_assoc()['id'];
        
        
        header('Location: home.php');
        exit();
    } else {
    
        echo '<script type="text/javascript">alert("Try again :("); 
                                              window.location.href = "http://localhost/domaci1php/login.php";</script>';
        exit();
    }
}


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/loginForm.css">
    
    <title>Notes</title>
</head>
<body>

<div class="form">
<form method="GET" action="#"> 
      <div class="title">Welcome</div>
      <div class="subtitle">Let's write your notes</div>
      <div class="input-container ic1">
        <input id="username" class="input" type="text" name="username" placeholder="" />
        <div class="cut"></div>
        <label for="username" class="placeholder">Username</label>
      </div>
      <div class="input-container ic2">
        <input id="password" class="input" type="password" name="password" placeholder="" />
        <div class="cut"></div>
        <label for="password" class="placeholder">Password</label>
      </div>
      <button type="submit" name="submit" class="submit">Log In</button>
</form>
    </div>
    
</body>
</html>