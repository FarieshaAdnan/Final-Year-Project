<h2 class="text-center">Dashboard Overview</h2>

   <?php
    // Total vehicles
        $totalVehicles = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM vehicles"))['total'];

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
window.addEventListener('load', function () {

    let map = L.map('map').setView([5.3630, 100.4667], 13);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; OpenStreetMap contributors'
    }).addTo(map);

    // bus stops
    L.marker([3.14675, 101.69554]).addTo(map)
        .bindPopup("KL113");

    L.marker([3.14924, 101.69479]).addTo(map)
        .bindPopup("KL117");

    // vehicle data
    fetch('/FinalYearProject/api/get_locations.php')
    .then(res => res.json())
    .then(data => {
        data.forEach(v => {
            let color = v.status === 'outside' ? 'red' : 'green';

            L.circleMarker([v.latitude, v.longitude], {
                color: color
            }).addTo(map)
            .bindPopup("Vehicle: " + v.vehicle_id);
        });
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
