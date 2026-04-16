<?php
include 'config.php';

$id = $_POST['id'];

$conn->query("UPDATE vehicles SET
bus_id='$_POST[bus_id]',
plate_number='$_POST[plate]',
driver_name='$_POST[driver]',
route='$_POST[route]'
WHERE id=$id");

header("Location: vehicles.php");
?>