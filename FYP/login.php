<?php
if($_SERVER["REQUEST_METHOD"] != "POST"){
    header("Location: index.php");
    exit();
}
session_start();
include 'config.php';

$username = $_POST['username'];
$password = $_POST['password'];

$result = $conn->query("SELECT * FROM users WHERE username='$username'");

if($result->num_rows > 0){
    $user = $result->fetch_assoc();

    if(password_verify($password, $user['password'])){
        
        $_SESSION['user'] = $username;

        // remember me
        if(isset($_POST['remember'])){
            setcookie("user", $username, time()+86400*30, "/");
        }

        header("Location: dashboard.php");
        exit();
    }
}

echo "Invalid login";
?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<form method="POST">
    <input type="text" name="username" placeholder="Username" required>
    <input type="password" name="password" placeholder="Password" required>
    <button type="submit">Login</button>
</form>