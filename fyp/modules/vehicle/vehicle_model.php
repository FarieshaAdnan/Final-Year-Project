<?php

function addVehicle($conn, $bus_id, $plate, $driver)
{
    $query = "
        INSERT INTO vehicles
        (bus_id, plate_number, driver_name)
        VALUES
        ('$bus_id', '$plate', '$driver')
    ";

    return mysqli_query($conn, $query);
}

function getVehicles($conn)
{
    return mysqli_query($conn,
        "SELECT * FROM vehicles ORDER BY id DESC"
    );
}

function deleteVehicle($conn, $id)
{
    return mysqli_query($conn,
        "DELETE FROM vehicles WHERE id='$id'"
    );
}