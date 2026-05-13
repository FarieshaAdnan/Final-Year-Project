<?php
include('../../includes/navbar.php');
?>

<div id="map" style="height: 500px;"></div>
<h3 id="result">Waiting for data...</h3>
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

<script>
    //bus icon
    const busIcon = L.icon({
    iconUrl: 'fyp/img/bus.jpg',   // your bus image path
    iconSize: [40, 40],   // adjust size
    iconAnchor: [20, 20], // center point
});
    //bus stops
    const busStops = [
    { name: "KL113", lat: 3.14675, lng: 101.69554, radius: 50 },
    { name: "Kl117", lat: 3.14924, lng: 101.69479, radius: 50 },
    { name: "Kl31", lat: 3.15286, lng: 101.69597, radius: 50 },
];
let vehicle_id = 1;

// Initialize map
let map = L.map('map').setView([5.3630, 100.4667], 13);

// Load map tiles
L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; OpenStreetMap contributors'
}).addTo(map);

// Create marker
const marker = L.marker([3.14675, 101.69554], { icon: busIcon }).addTo(map);

let currentStop = 0;

function sendLocation() {

    // GET CURRENT STOP
    let stop = busStops[currentStop];

    let lat = stop.lat;
    let lng = stop.lng;

    // MOVE MARKER
    marker.setLatLng([lat, lng]);

    // CENTER MAP
    map.setView([lat, lng], 15);

    // POPUP
    marker.bindPopup("Bus arrived at " + stop.name).openPopup();

    fetch('/fyp/api/check_geofence.php', {

        method: 'POST',

        headers: {
            'Content-Type': 'application/json'
        },

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
                "✅ Inside Geofence: " + stop.name;

        }

    });

    // NEXT STOP
    currentStop++;

    // LOOP BACK
    if (currentStop >= busStops.length) {
        currentStop = 0;
    }
}

busStops.forEach(stop => {

    // BUS STOP MARKER
    L.marker([stop.lat, stop.lng])
        .addTo(map)
        .bindPopup(stop.name);

    // GEOFENCE CIRCLE
    L.circle([stop.lat, stop.lng], {
        radius: stop.radius,
        color: 'red',
        fillOpacity: 0.2
    }).addTo(map);

});

function moveMarker(marker, newLat, newLng) {
    marker.setLatLng([newLat, newLng]);
}

function animateMarker(marker, from, to, steps = 100) {
    let i = 0;

    const latStep = (to[0] - from[0]) / steps;
    const lngStep = (to[1] - from[1]) / steps;

    const interval = setInterval(() => {
        if (i >= steps) {
            clearInterval(interval);
            return;
        }

        from[0] += latStep;
        from[1] += lngStep;

        marker.setLatLng(from);
        i++;
    }, 30); // speed control
}

busStops.forEach(stop => {
    L.circle([stop.lat, stop.lng], {
        radius: stop.radius,
        color: 'blue',
        fillColor: '#blue',
        fillOpacity: 0.2
    }).addTo(map)
    .bindPopup(stop.name);
});

function isInsideGeofence(busLat, busLng, stop) {
    const distance = map.distance(
        [busLat, busLng],
        [stop.lat, stop.lng]
    );

    return distance <= stop.radius;
}

function checkBusStops(busLat, busLng) {
    busStops.forEach(stop => {
        if (isInsideGeofence(busLat, busLng, stop)) {
            console.log("Bus arrived at:", stop.name);
        }
    });
}

marker.on('move', function() {
    const pos = marker.getLatLng();
    checkBusStops(pos.lat, pos.lng);
});

let visitedStops = new Set();

function checkBusStops(busLat, busLng) {
    busStops.forEach(stop => {
        const inside = isInsideGeofence(busLat, busLng, stop);

        if (inside && !visitedStops.has(stop.name)) {
            visitedStops.add(stop.name);
            console.log("Arrived at:", stop.name);
        }

        if (!inside && visitedStops.has(stop.name)) {
            visitedStops.delete(stop.name);
        }
    });
}

fetch("update_bus_status.php", {
    method: "POST",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify({
        stop: stop.name,
        status: "ARRIVED"
    })
});


// Run real-time
sendLocation();
setInterval(sendLocation, 5000);
</script>

<?php
include('../../includes/footer.php');
?>