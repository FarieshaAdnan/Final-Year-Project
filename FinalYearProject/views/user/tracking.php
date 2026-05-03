<div id="map" style="height: 500px;"></div>
<h3 id="result">Waiting for data...</h3>
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

<script>
let vehicle_id = 1;

// Initialize map
let map = L.map('map').setView([5.3630, 100.4667], 13);

// Load map tiles
L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; OpenStreetMap contributors'
}).addTo(map);

// Create marker
let marker = L.marker([5.3630, 100.4667]).addTo(map);

function sendLocation() {

    let lat = 5.3630 + (Math.random() * 0.01);
    let lng = 100.4667 + (Math.random() * 0.01);

    // Move marker
    marker.setLatLng([lat, lng]);
    map.setView([lat, lng]);

    fetch('http://localhost/FinalYearProject/api/check_geofence.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({
            vehicle_id: vehicle_id,
            lat: lat,
            lng: lng
        })
    })
    .then(res => res.json())
    .then(data => {

        if (data.status === "outside") {
            document.getElementById("result").innerHTML =
                "❌ OUTSIDE GEOFENCE - ALERT!";
        } else {
            document.getElementById("result").innerHTML =
                "✅ Inside Geofence";
        }
    });
}

// Run real-time
sendLocation();
setInterval(sendLocation, 5000);
</script>