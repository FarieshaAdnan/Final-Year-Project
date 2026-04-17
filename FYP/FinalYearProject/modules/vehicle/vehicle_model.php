<?php
include('../../config/db.php');

// Add vehicle
function addVehicle($conn, $bus_id, $plate_number, $driver_name) {
    $query = "INSERT INTO vehicle (bus_id, plate_number, driver_name)
              VALUES ('$bus_id', '$plate_number', '$driver_name')";
    return mysqli_query($conn, $query);
}

// Get all vehicles
function getVehicles($conn) {
    $query = "SELECT * FROM vehicle";
    return mysqli_query($conn, $query);
}

// Delete vehicle
function deleteVehicle($conn, $id) {
    $query = "DELETE FROM vehicle WHERE id = $id";
    return mysqli_query($conn, $query);
}
?>