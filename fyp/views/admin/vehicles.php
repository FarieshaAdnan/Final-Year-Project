<?php

session_start();

if ($_SESSION['role'] != 'admin') {
    header("Location: ../../index.php");
    exit();
}

include(__DIR__ . '/../../config/db.php');
include(__DIR__ . '/../../modules/vehicle/vehicle_model.php');

// ADD VEHICLE
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $bus_id = $_POST['bus_id'];
    $plate = $_POST['plate_number'];
    $driver = $_POST['driver_name'];

    addVehicle($conn, $bus_id, $plate, $driver);

    header("Location: vehicles.php");
    exit();
}

// DELETE VEHICLE
if (isset($_GET['delete'])) {

    deleteVehicle($conn, $_GET['delete']);

    header("Location: vehicles.php");
    exit();
}

// LOAD CONTENT PAGE
$page_content = 'vehicles_content.php';

// LOAD LAYOUT
include(__DIR__ . '/../../layouts/admin_layout.php');