<?php
include('../../config/db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $full_name = mysqli_real_escape_string($conn, $_POST['full_name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];

    $query = "
    INSERT INTO users (
        full_name,
        email,
        password,
        role
    )
    VALUES (
        '$full_name',
        '$email',
        '$password',
        'user'
    )
    ";

    if (mysqli_query($conn, $query)) {

        header("Location: ../../index.php");
        exit();

    } else {

        echo "Registration failed";
    }
}
?>