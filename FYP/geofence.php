<?php
function isInsideGeofence($lat, $lng) {

    // Example boundary (rectangle)
    $minLat = 3.1300;
    $maxLat = 3.1500;
    $minLng = 101.6700;
    $maxLng = 101.7000;

    if ($lat >= $minLat && $lat <= $maxLat &&
        $lng >= $minLng && $lng <= $maxLng) {
        return true;
    }

    return false;
}
?>