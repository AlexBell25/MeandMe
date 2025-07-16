<?php
if(isset($_POST["submit"])){
    
    $name = $_POST["user"];
    $email= $_POST["email"];
    $pwd = $_POST["password"];
    $confirm = $_POST["confirmPassword"];

    require_once "dbh.inc.php";
    require_once "function.inc.php";

    if (emptyInputSignup($name, $email, $pwd, $confirm) != false){
        header("location: /signup.html?error=emptyinput");
        exit();
    }
        if (invalidusername($name) != false){
        header("location: /signup.html?error=invaliduid");
        exit();
    }
        if (invalidemail($email) != false){
        header("location: /signup.html?error=invalidemail");
        exit();
    }
        if (pwdMatch($pwd,$confirm) != false){
        header("location: /signup.html?error=passwordsdontmatch");
        exit();
    }
        if (userexists($conn, $name, $email) != false){
        header("location: /signup.html?error=usernametaken");
        exit();
    }
    createUser($conn, $name, $pwd, $email);
    header("location /login.html");
    exit();
}
else{
    header("location: /signup.html");
    exit();
}