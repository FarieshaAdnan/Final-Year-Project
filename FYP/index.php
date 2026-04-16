<?php
session_start();

// If already logged in → go dashboard
if(isset($_SESSION['user'])){
    header("Location: dashboard.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #f0f0f0;
        }

        .login-box {
            width: 350px;
            margin: 100px auto;
            padding: 30px;
            background: white;
            border-radius: 10px;
        }
    </style>
</head>

<body>

<div class="login-box">
    <h4 class="text-center">Sign In</h4>

    <form action="login.php" method="POST">

        <input type="text" name="username" class="form-control mb-2" placeholder="Username" required>

        <input type="password" name="password" class="form-control mb-2" placeholder="Password" required>

        <!-- Role selection -->
        <select name="role" class="form-control mb-2">
            <option value="staff">Staff</option>
            <option value="user">Personal</option>
        </select>

        <!-- Remember me -->
        <div class="form-check mb-2">
            <input type="checkbox" name="remember" class="form-check-input">
            <label class="form-check-label">Keep me logged in</label>
        </div>

        <button class="btn btn-dark w-100">Login</button>

        <div class="text-center mt-2">
            <a href="forgot_password.php">Forgot Password?</a>
        </div>

    </form>
</div>

</body>
</html>