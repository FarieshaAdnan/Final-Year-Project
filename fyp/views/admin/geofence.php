<?php
session_start();
if ($_SESSION['role'] != 'admin') {
    header("Location: ../../index.php");
    exit();
}

include('../../includes/header.php');
include('../../includes/navbar.php');
?>

<h2>Create Geofence</h2>

<div id="map" style="height: 500px;"></div>

<br>
<button onclick="saveGeofence()">Save Geofence</button>

<!-- Leaflet CSS -->
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />

<!-- Leaflet JS -->
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

<!-- Leaflet Draw Plugin -->
<link rel="stylesheet" href="https://unpkg.com/leaflet-draw/dist/leaflet.draw.css"/>
<script src="https://unpkg.com/leaflet-draw/dist/leaflet.draw.js"></script>

<script src="../../assets/js/geofence.js"></script>

<?php include('../../includes/footer.php'); ?>