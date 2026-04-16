<?php
include 'config.php';
include 'geofence.php';
include 'layout.php';

$bus_id = 1;

// simulate movement
$lat = 3.1390 + rand(-10,10)/1000;
$lng = 101.6869 + rand(-10,10)/1000;

$conn->query("INSERT INTO gps_data (bus_id, latitude, longitude)
              VALUES ('$bus_id', '$lat', '$lng')");

// check geofence
if (!isInsideGeofence($lat, $lng)) {
    $conn->query("INSERT INTO alerts (bus_id, message, status)
                  VALUES ('$bus_id', 'Bus خارج route!', 'unresolved')");
}
?>