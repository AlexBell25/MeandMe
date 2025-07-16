<?php
session_start(); // start session to set variables


if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST["username"];
    $pwd= $_POST["password"];

    require_once 'dbh.inc.php';
    require_once 'function.inc.php';

    if (emptyInputlogin($username, $pwd) != false){
        header("location: /login.php?error=emptyinput");
        exit();
    }


    loginUser($conn, $username, $pwd);
    



}
else{
    header("location: /login.php");
    exit();
}