let map = L.map('map').setView([5.3630, 100.4667], 13); // Penang area

// Load OpenStreetMap tiles
L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; OpenStreetMap contributors'
}).addTo(map);

// Feature group to store drawn shapes
let drawnItems = new L.FeatureGroup();
map.addLayer(drawnItems);

// Draw control
let drawControl = new L.Control.Draw({
    draw: {
        polygon: true,
        rectangle: false,
        circle: false,
        marker: false,
        polyline: false
    },
    edit: {
        featureGroup: drawnItems
    }
});

map.addControl(drawControl);

let currentLayer = null;

// When user draws polygon
map.on(L.Draw.Event.CREATED, function (event) {
    if (currentLayer) {
        drawnItems.removeLayer(currentLayer);
    }

    currentLayer = event.layer;
    drawnItems.addLayer(currentLayer);
});

// Save geofence
function saveGeofence() {
    if (!currentLayer) {
        alert("Draw a geofence first!");
        return;
    }

    let latlngs = currentLayer.getLatLngs()[0];

    let coordinates = latlngs.map(point => ({
        lat: point.lat,
        lng: point.lng
    }));

    fetch('../../api/save_geofence.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ coordinates: coordinates })
    })
    .then(res => res.json())
    .then(data => {
        alert("Geofence saved!");
    });
}