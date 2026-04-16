<?php
session_start();

// If session exists → allow
if(isset($_SESSION['user'])){
    return;
}

// If cookie exists → restore session
if(isset($_COOKIE['user'])){
    $_SESSION['user'] = $_COOKIE['user'];
    return;
}

// If none → go login
header("Location: index.php");
exit();
?>