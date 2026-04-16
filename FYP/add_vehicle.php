<?php
include 'config.php';

$bus = $_POST['bus_id'];
$plate = $_POST['plate'];
$driver = $_POST['driver'];
$route = $_POST['route'];
$status = $_POST['status'];

$conn->query("INSERT INTO vehicles 
(bus_id, plate_number, driver_name, route, status)
VALUES ('$bus','$plate','$driver','$route','$status')");

header("Location: vehicles.php");
?>