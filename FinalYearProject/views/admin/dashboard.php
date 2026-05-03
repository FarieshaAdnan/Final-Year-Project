<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<?php
session_start();

if ($_SESSION['role'] != 'admin') {
    header("Location: /index.php");
    exit();
}

include('../../config/db.php');
include('../../includes/header.php');
include('../../includes/navbar.php');
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <title>Admin Dashboard</title>
    <style>
        body {
            background-color: #F5EBDD;
        }

        .navbar {
            background: white;
            border-radius: 10px;
            margin: 15px;
            padding: 10px 20px;
        }

        .card {
            border-radius: 15px;
        }

        .chart-box {
            height: 200px;
            background: #f1f1f1;
            border-radius: 10px;
        }
    </style>
  </head>
  <body>
   <center><h2>Dashboard Overview</h2></center>

   <?php
    // Total vehicles
        $totalVehicles = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM vehicle"))['total'];

    // Inside count
        $insideCount = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM tracking_logs WHERE status='inside'"))['total'];

    // Outside count
        $outsideCount = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM tracking_logs WHERE status='outside'"))['total'];
    ?>

<div class="container">
    <h2 class="text-center text-danger mb-4">Welcome User</h2>
     <div class="row">
        <!-- Chart -->
        <div class="col-md-8">
            <div class="card p-3">
                <div class="chart-box"></div>
            </div>
        </div>

         <!-- Stats -->
        <div class="col-md-4">
            <div class="card p-3 mb-3">
                <h5>$24.5</h5>
                <p>Revenue</p>
            </div>

            <div class="card p-3 mb-3">
                <h5>9.5%</h5>
                <p>Growth</p>
            </div>

            <div class="card p-3">
                <h5>19.1%</h5>
                <p>Performance</p>
            </div>
        </div>
    </div>

    <!-- Table -->
    <div class="card mt-4 p-3">
        <h5>Stage Bus Route</h5>
        <table class="table">
            <tr><th>Location</th></tr>
            <tr><td>Rawang</td></tr>
            <tr><td>Serdang</td></tr>
            <tr><td>Kajang</td></tr>
        </table>
    </div>

</div>

<div class="main">
<h2>Admin Dashboard</h2>

<div class="cards">
    <div class="card">🚍 Total Vehicles<br><strong><?php echo $totalVehicles; ?></strong></div>
    <div class="card">✅ Inside<br><strong><?php echo $insideCount; ?></strong></div>
    <div class="card">❌ Outside<br><strong><?php echo $outsideCount; ?></strong></div>
</div>

<div style="width: 400px; height: 400px; margin: auto;">
<canvas id="statusChart" width="400" height="200"></canvas>

<script>
let inside = <?php echo $insideCount; ?>;
let outside = <?php echo $outsideCount; ?>;

new Chart(document.getElementById('statusChart'), {
    type: 'pie',
    data: {
        labels: ['Inside', 'Outside'],
        datasets: [{
            data: [inside, outside],
            backgroundColor: ['green', 'red']
        }]
    }
});
</script>
</div>
<hr>

<h3>Recent Alerts</h3>

<?php
$result = mysqli_query($conn, "
    SELECT * FROM tracking_logs 
    WHERE status='outside' 
    ORDER BY timestamp DESC 
    LIMIT 5
");

while ($row = mysqli_fetch_assoc($result)) {
    echo "<div class='alert'>
            Vehicle ID: {$row['vehicle_id']} |
            Status: {$row['status']} |
            Time: {$row['timestamp']}
          </div>";
}
?>

<h3>Live Map</h3>
<div id="map" style="height: 400px;"></div>

<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css"/>
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

<script>
let map = L.map('map').setView([5.3630, 100.4667], 13);

L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);

/// POI MARKERS (ADD HERE)
L.marker([5.3650, 100.4700]).addTo(map)
    .bindPopup("Bus Stop A");

L.marker([5.3600, 100.4600]).addTo(map)
    .bindPopup("Main Campus");

/// 🚗 VEHICLE DATA
fetch('/FinalYearProject/api/get_locations.php')
.then(res => res.json())
.then(data => {
    data.forEach(v => {
        let color = v.status === 'outside' ? 'red' : 'green';

        let marker = L.circleMarker([v.latitude, v.longitude], {
            color: color
        }).addTo(map);

        marker.bindPopup("Vehicle: " + v.vehicle_id);
    });
});
</script>

<h3>Tracking Logs</h3>

<form method="GET">
    <input type="text" name="search" placeholder="Vehicle ID">
    <input type="date" name="date">
    <button type="submit">Filter</button>
</form>

<?php
$search = $_GET['search'] ?? '';
$date = $_GET['date'] ?? '';

$query = "SELECT * FROM tracking_logs WHERE 1";

if ($search != '') {
    $query .= " AND vehicle_id LIKE '%$search%'";
}

if ($date != '') {
    $query .= " AND DATE(timestamp) = '$date'";
}

$query .= " ORDER BY timestamp DESC";

$result = mysqli_query($conn, $query);
?>

<table border="1" style="margin:20px;">
<tr>
    <th>Vehicle</th>
    <th>Latitude</th>
    <th>Longitude</th>
    <th>Status</th>
    <th>Time</th>
</tr>

<?php while ($row = mysqli_fetch_assoc($result)) { ?>
<tr>
    <td><?= $row['vehicle_id'] ?></td>
    <td><?= $row['latitude'] ?></td>
    <td><?= $row['longitude'] ?></td>
    <td><?= $row['status'] ?></td>
    <td><?= $row['timestamp'] ?></td>
</tr>
<?php } ?>
</table>

</div>
<?php include('../../includes/footer.php'); ?>

 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
  </body>
  </html>