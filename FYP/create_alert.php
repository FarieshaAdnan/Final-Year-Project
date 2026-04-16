<?php
include 'config.php';
include 'layout.php';

$bus_id = $_POST['bus_id'];
$message = $_POST['message'];

$conn->query("INSERT INTO alerts (bus_id, message, status) 
              VALUES ('$bus_id', '$message', 'unresolved')");
?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">