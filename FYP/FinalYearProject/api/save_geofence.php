<?php
include('../config/db.php');

$data = json_decode(file_get_contents("php://input"), true);

$coordinates = json_encode($data['coordinates']);

$query = "INSERT INTO geofence (name, coordinates)
          VALUES ('Main Area', '$coordinates')";

if (mysqli_query($conn, $query)) {
    echo json_encode(["status" => "success"]);
} else {
    echo json_encode(["status" => "error"]);
}
?>