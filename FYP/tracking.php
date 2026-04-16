<?php include 'layout.php'; ?>

<div class="content">

<h3>Live Tracking</h3>

<!-- 🔍 SEARCH -->
<div class="mb-3">
    <input type="text" id="searchBus" class="form-control" placeholder="Search bus line (e.g ML80)">
</div>

<!-- ETA INFO -->
<div id="busInfo" class="mb-3"></div>

<!-- MAP -->
<div id="map" style="height:500px;"></div>

</div>

<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

<script>
let map = L.map('map').setView([3.1390,101.6869], 13);

L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png')
.addTo(map);

// 🔴 Geofence
var bounds = [
    [3.1300,101.6700],
    [3.1500,101.7000]
];
L.rectangle(bounds,{color:"red", fillOpacity:0.2}).addTo(map);

let markers = [];

function loadData(){

fetch("get_gps.php")
.then(res=>res.json())
.then(data=>{

    markers.forEach(m=>map.removeLayer(m));
    markers=[];

    let search = document.getElementById("searchBus").value.toLowerCase();

    data.forEach(bus=>{

        // filter search
        if(search && !bus.bus_id.toLowerCase().includes(search)) return;

        let marker = L.marker([bus.latitude,bus.longitude]).addTo(map);

        marker.bindPopup("Bus: "+bus.bus_id);

        markers.push(marker);

        // fake ETA
        document.getElementById("busInfo").innerHTML =
            "<b>Bus:</b> "+bus.bus_id+
            " | Arrival: 5 mins | Departure: 10 mins";

    });

});
}

// 🔄 auto refresh
setInterval(loadData,3000);
loadData();

// simulate movement
setInterval(()=>{
    fetch("simulate_gps.php");
},2000);

</script>