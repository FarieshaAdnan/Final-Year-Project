<?php
include 'config.php';
include 'layout.php';

$result = $conn->query("
    SELECT * FROM gps_data 
    WHERE id IN (
        SELECT MAX(id) FROM gps_data GROUP BY bus_id
    )
");

$data = [];
while($row = $result->fetch_assoc()){
    $data[] = $row;
}

echo json_encode($data);
?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">