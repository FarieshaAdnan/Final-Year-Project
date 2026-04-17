<?php
session_start();
include('../../config/db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = $_POST['password'];

    $query = "SELECT * FROM users WHERE username='$username' LIMIT 1";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) == 1) {

        $user = mysqli_fetch_assoc($result);

        // Simple password check (we upgrade later if needed)
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
            echo "Wrong password";
        }

    } else {
        echo "User not found";
    }
}
?>