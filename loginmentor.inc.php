<?php

if (isset($_POST["submit"])){
    $username = $_POST["user"];
    $pwd= $_POST["password"];

    require_once 'dbh.inc.php';
    require_once 'function.inc.php';

    if (emptyInputlogin($username, $pwd) != false){
        header("location: /login mentor.php?error=emptyinput");
        exit();
    }

    loginmentor($conn, $username, $pwd);
    



}
else{
    header("location: /login mentor.php");
    exit();
}