<?php
if(isset($_POST["submit"])){
    
    $name = $_POST["user"];
    $email= $_POST["email"];
    $pwd = $_POST["password"];
    $confirm = $_POST["confirmPassword"];
    $role = $_POST["role"];

    require_once "dbh.inc.php";
    require_once "function.inc.php";

    if (emptyInputSignup($name, $email, $pwd, $confirm) != false){
        header("location: /signup.php?error=emptyinput");
        exit();
    }
        if (invalidusername($name) != false){
        header("location: /signup.php?error=invaliduid");
        exit();
    }
        if (invalidemail($email) != false){
        header("location: /signup.php?error=invalidemail");
        exit();
    }
        if (pwdMatch($pwd,$confirm) != false){
        header("location: /signup.php?error=passwordsdontmatch");
        exit();
    }
        if (userexists($conn, $name, $email) != false){
        header("location: /signup.php?error=usernametaken");
        exit();
    }
    createUser($conn, $name, $pwd, $email, $role);
    header("location: /login.php");
    exit();
}
else{
    header("location: /signup.php");
    exit();
}