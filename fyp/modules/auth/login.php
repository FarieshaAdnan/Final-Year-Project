<?php 
session_start();
include('../../config/db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];

    $query = "SELECT * FROM users WHERE email='$email' LIMIT 1";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) == 1) {

        $user = mysqli_fetch_assoc($result);

        if ($password === $user['password']) {

            $_SESSION['user_id'] = $user['id'];
            $_SESSION['role'] = $user['role'];

            if ($user['role'] === 'admin') {
                header("Location: ../../views/admin/dashboard.php");
            } else {
                header("Location: ../../views/user/dashboard.php");
            }
            exit();

        } else {
            $_SESSION['error'] = "Wrong password";
            header("Location: ../../index.php");
            exit();
        }

    } else {
        $_SESSION['error'] = "User not found";
        header("Location: ../../index.php");
        exit();
    }
}
?>