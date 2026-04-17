let vehicle_id = 1;

function sendLocation() {

    let lat = 5.3630 + (Math.random() * 0.01);
    let lng = 100.4667 + (Math.random() * 0.01);

    fetch('../../api/check_geofence.php', {
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

        console.log("API RESPONSE:", data); // 🔥 DEBUG

        if (data.status === "outside") {
            document.getElementById("result").innerHTML =
                "❌ OUTSIDE GEOFENCE - ALERT!";
        } else {
            document.getElementById("result").innerHTML =
                "✅ Inside Geofence";
        }
    })
    .catch(err => {
        console.error("ERROR:", err);
        document.getElementById("result").innerHTML =
            "⚠️ API ERROR (check console)";
    });
}

// run immediately + interval
sendLocation();
setInterval(sendLocation, 5000);