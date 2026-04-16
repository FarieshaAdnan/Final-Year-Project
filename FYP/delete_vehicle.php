<?php
include 'config.php';

$id = $_GET['id'];

$conn->query("DELETE FROM vehicles WHERE id=$id");

header("Location: vehicles.php");
?>