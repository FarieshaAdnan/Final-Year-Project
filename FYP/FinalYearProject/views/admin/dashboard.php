<?php
session_start();

if ($_SESSION['role'] != 'admin') {
    header("Location: /index.php");
    exit();
}
?>

<?php 
include('../../includes/header.php'); 
?>
<?php 
include('../../includes/navbar.php'); 
?>

<html>
    <head>
        <title>Admin Dashboard</title>
    </head>

    <body>
        <h1>Admin Dashboard</h1>

<?php 
include('../../includes/footer.php'); 
?>
    </body>
</html>