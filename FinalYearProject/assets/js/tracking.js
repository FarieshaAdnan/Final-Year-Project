let vehicle_id = 1;

function sendLocation() {

    let lat = 5.3630 + (Math.random() * 0.01);
    let lng = 100.4667 + (Math.random() * 0.01);

    console.log("Sending:", lat, lng);

    fetch('http://localhost/FinalYearProject/api/check_geofence.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            vehicle_id: 1,
            lat: lat,
            lng: lng
        })
    })
    .then(res => res.text())
    .then(text => {
        console.log("RAW RESPONSE:", text);

    let data = JSON.parse(text);

    if (data.status === "outside") {
        document.getElementById("result").innerHTML =
            "❌ OUTSIDE GEOFENCE - ALERT!";
    } else {
        document.getElementById("result").innerHTML =
            "✅ Inside Geofence";
    }
})
    .catch(err => console.error(err));
}

sendLocation();
setInterval(sendLocation, 5000);