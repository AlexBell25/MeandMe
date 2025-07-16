<?php

function emptyInputSignup($name, $email, $pwd, $confirm){
    if (empty($name) || empty($email) || empty($pwd) || empty($confirm)){
        $result = true;

    }
    else{
        $result = false;
    }
    return $result;
}

function invalidusername($name){
    if (!preg_match("/^[a-zA-Z0-9]*$/",$name)){
        $result = true;

    }
    else{
        $result = false;
    }
    return $result;
}

function invalidemail($email){
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $result = true;

    }
    else{
        $result = false;
    }
    return $result;
}

function pwdMatch($pwd,$confirm){
    if ($pwd != $confirm){
        $result = true;

    }
    else{
        $result = false;
    }
    return $result;
}

function userexists($conn, $name, $email){
 $sql = "SELECT * FROM login WHERE username = ? OR email = ?;";
 $stmt = mysqli_stmt_init($conn);
 if(!mysqli_stmt_prepare($stmt,$sql)){
    header("Location: /signup.html?error=stmtfailed");
    exit();
 }

 mysqli_stmt_bind_param($stmt, "ss", $name, $email);
 mysqli_stmt_execute($stmt);

 $resultData = mysqli_stmt_get_result($stmt);

 if ($row = mysqli_fetch_assoc($resultData)){
    mysqli_stmt_close($stmt);
    return $row;
 }
 else{
    mysqli_stmt_close($stmt);
    $result = false;
    return $result;
 }


}

function createUser($conn, $name,$pwd, $email){
 $sql = "INSERT INTO login (username, email, pass) VALUES (?, ?, ?);";
 $stmt = mysqli_stmt_init($conn);
 if(!mysqli_stmt_prepare($stmt,$sql)){
    header("Location: /signup.html?error=stmtfailed");
    exit();
 }
$hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

 mysqli_stmt_bind_param($stmt, "sss", $name, $email, $hashedPwd);
 mysqli_stmt_execute($stmt);
 mysqli_stmt_close($stmt);
 header("Location: /index.php?error=none");
 exit();
}

function emptyInputlogin($name, $pwd){
    if (empty($name) || empty($pwd)){
        $result = true;

    }
    else{
        $result = false;
    }
    return $result;
}

function loginUser($conn, $username, $pwd){
    $userExists = userexists($conn, $username, $username);

    if ($userExists === false){
        header("location: /login.php?error=wronglogin");
        exit();
    }

    $pwdHashed = $userExists["pass"];
    $checkpwd = password_verify($pwd, $pwdHashed);

    if ($checkpwd === false){
        header("location:login.php?error=wronglogin");
        exit();
    }
    else if($checkpwd === true){
        session_start();
        $_SESSION["userid"] =  $userExists["usersId"];
        $_SESSION["username"] =  $userExists["username"];
        header("location: /index.php");
        exit();
    }
}
function loginmentor($conn, $username, $pwd){
    $userExists = userexists($conn, $username, $username);

    if ($userExists === false){
        header("location: /login mentor.php?error=wronglogin");
        exit();
    }

    $pwdHashed = $userExists["pass"];
    $checkpwd = password_verify($pwd, $pwdHashed);

    if ($checkpwd === false){
        header("location:login.php?error=wronglogin");
        exit();
    }
    else if($checkpwd === true){
        session_start();
        $_SESSION["userid"] =  $userExists["usersId"];
        $_SESSION["username"] =  $userExists["username"];
        header("location: /index.php");
        exit();
    }
}