<?php include('includes/header.php'); ?>

<h2>Login</h2>

<form method="POST" action="modules/auth/login.php">
    <input type="text" name="username" placeholder="Username" required><br><br>
    <input type="password" name="password" placeholder="Password" required><br><br>
    <button type="submit">Login</button>
</form>

<?php include('includes/footer.php'); ?>