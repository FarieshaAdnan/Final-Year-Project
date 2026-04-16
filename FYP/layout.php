<?php include 'auth_check.php'; ?>
<!DOCTYPE html>
<html>
<head>
<title>System</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css"/>

<style>
body {
    margin:0;
    font-family: Arial;
    background: #f5f5f5;
}

/* 🌙 Dark mode */
body.dark {
    background: #1e1e1e;
    color: white;
}

/* TOP BAR */
.topbar {
    height:60px;
    background:#e0e0e0;
    display:flex;
    justify-content:space-between;
    align-items:center;
    padding:0 20px;
    position:fixed;
    width:100%;
    top:0;
    z-index:1000;
}

/* SIDEBAR */
.sidebar {
    position:fixed;
    top:60px;
    left:0;
    width:220px;
    height:calc(100% - 60px);
    background:#fff;
    display:flex;
    flex-direction:column;
    justify-content:space-between;
}

/* ACTIVE MENU */
.sidebar a.active {
    background:#ddd;
    font-weight:bold;
}

.sidebar a {
    padding:12px 20px;
    display:block;
    text-decoration:none;
    color:#333;
}

/* CONTENT */
.content {
    margin-left:220px;
    margin-top:60px;
    padding:20px;
}

/* PROFILE */
.profile img {
    width:35px;
    height:35px;
    border-radius:50%;
}

/* DROPDOWN */
.dropdown-menu-custom {
    display:none;
    position:absolute;
    right:20px;
    top:60px;
    background:white;
    border:1px solid #ddd;
}

/* NOTIFICATION */
.badge-alert {
    background:red;
    color:white;
    border-radius:50%;
    padding:3px 6px;
    font-size:12px;
}
</style>
</head>

<body>

<!-- 🔷 TOP BAR -->
<div class="topbar">

    <div><strong>Bus System</strong></div>

    <div class="d-flex align-items-center gap-3">

        <!-- 🔔 Notification -->
        <div>
            🔔 <span class="badge-alert">2</span>
        </div>

        <!-- 🌙 Dark mode -->
        <button onclick="toggleDark()">🌙</button>

        <!-- 👤 Profile -->
        <div onclick="toggleMenu()" style="cursor:pointer;">
        </div>

    </div>

</div>

<!-- DROPDOWN -->
<div class="dropdown-menu-custom" id="dropdown">
    <a href="profile.php">Settings</a>
    <a href="logout.php">Logout</a>
</div>

<!-- SIDEBAR -->
<div class="sidebar">

    <div>
        <a href="dashboard.php">Dashboard</a>
        <a href="vehicles.php">Vehicles</a>
        <a href="tracking.php">Tracking</a>
        <a href="reports.php">Reports</a>
        <a href="schedule.php">Scheduling</a>
    </div>

    <div>
        <a href="help.php">Help</a>
        <a href="logout.php" class="text-danger">Logout</a>
    </div>

</div>

<script>
function toggleMenu(){
    let d = document.getElementById("dropdown");
    d.style.display = d.style.display === "block" ? "none" : "block";
}

function toggleDark(){
    document.body.classList.toggle("dark");
}
</script>