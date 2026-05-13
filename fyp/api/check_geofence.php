<?php
header("Content-Type: application/json"); // 👈 VERY IMPORTANT

include('../config/db.php');

$data = json_decode(file_get_contents("php://input"), true);

// DEBUG
if (!$data) {
    echo json_encode([
        "error" => "No JSON received",
        "raw" => file_get_contents("php://input")
    ]);
    exit();
}

$lat = $data['lat'] ?? 0;
$lng = $data['lng'] ?? 0;
$vehicle_id = $data['vehicle_id'] ?? 1;

// Get latest geofence
$query = "SELECT * FROM geofence ORDER BY id DESC LIMIT 1";
$result = mysqli_query($conn, $query);
$geofence = mysqli_fetch_assoc($result);

$polygon = json_decode($geofence['coordinates'], true);

function isInside($point, $polygon) {
    $inside = false;
    $j = count($polygon) - 1;

    for ($i = 0; $i < count($polygon); $i++) {
        $xi = $polygon[$i]['lat'];
        $yi = $polygon[$i]['lng'];
        $xj = $polygon[$j]['lat'];
        $yj = $polygon[$j]['lng'];

        $intersect = (($yi > $point['lng']) != ($yj > $point['lng'])) &&
            ($point['lat'] < ($xj - $xi) * ($point['lng'] - $yi) / ($yj - $yi + 0.0000001) + $xi);

        if ($intersect) $inside = !$inside;
        $j = $i;
    }

    return $inside;
}

$isInside = isInside(['lat'=>$lat,'lng'=>$lng], $polygon);

$status = $isInside ? "inside" : "outside";

// Save tracking log
$insert = "INSERT INTO tracking_logs (vehicle_id, latitude, longitude, status)
           VALUES ('$vehicle_id', '$lat', '$lng', '$status')";

mysqli_query($conn, $insert);

echo json_encode([
    "inside" => $isInside,
    "status" => $status
]);
?>