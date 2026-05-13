<?php

$conn = mysqli_connect(
    "localhost",
    "root",
    "root",
    "fyp_geofence",
    8889
);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

?>