<?php
session_start();

if ($_SESSION['role'] != 'user') {
    header("Location: /index.php");
    exit();
}
?>

<?php include('../../includes/header.php'); ?>
<?php include('../../includes/navbar.php'); ?>

<html>
    <head>
        <title>Dashboard</title>
    <body>
        <h1>User Dashboard</h1>
    </body>
<?php include('../../includes/footer.php'); ?>
</html>