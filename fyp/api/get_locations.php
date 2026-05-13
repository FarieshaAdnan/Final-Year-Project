<?php
include('../config/db.php');

$query = "
SELECT * FROM tracking_logs 
ORDER BY timestamp DESC
LIMIT 20
";

$result = mysqli_query($conn, $query);

$data = [];

while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;
}

echo json_encode($data);
?>