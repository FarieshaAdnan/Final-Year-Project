<?php include 'auth_check.php'; ?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            margin: 0;
            font-family: Arial;
            background: #f5f5f5;
        }

        /* 🔷 TOP BAR */
        .topbar {
            height: 60px;
            background: #e0e0e0;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 20px;
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1000;
        }

        /* 🔷 SIDEBAR */
        .sidebar {
            position: fixed;
            top: 60px;
            left: 0;
            width: 220px;
            height: calc(100% - 60px);
            background: #ffffff;
            border-right: 1px solid #ddd;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .menu {
            padding-top: 20px;
        }

        .menu a {
            display: block;
            padding: 12px 20px;
            color: #333;
            text-decoration: none;
        }

        .menu a:hover {
            background: #f0f0f0;
        }

        /* 🔻 Bottom menu */
        .bottom-menu {
            padding-bottom: 20px;
        }

        /* 🔷 MAIN CONTENT */
        .content {
            margin-left: 220px;
            margin-top: 60px;
            padding: 20px;
        }

        /* 🔷 Profile dropdown */
        .profile {
            position: relative;
            cursor: pointer;
        }

        .dropdown-menu-custom {
            display: none;
            position: absolute;
            right: 0;
            top: 50px;
            background: white;
            border: 1px solid #ddd;
            width: 150px;
        }

        .dropdown-menu-custom a {
            display: block;
            padding: 10px;
            text-decoration: none;
            color: #333;
        }

        .dropdown-menu-custom a:hover {
            background: #f0f0f0;
        }
    </style>
</head>

<body>

<!-- 🔷 TOP BAR -->
<div class="topbar">
    <div><strong>Company Logo</strong></div>

    <div class="profile" onclick="toggleMenu()">
        👤 Profile
        <div class="dropdown-menu-custom" id="dropdown">
            <a href="profile.php">Settings</a>
            <a href="logout.php">Logout</a>
        </div>
    </div>
</div>

<!-- 🔷 SIDEBAR -->
<div class="sidebar">

    <!-- TOP MENU -->
    <div class="menu">
        <a href="dashboard.php">Dashboard</a>
        <a href="vehicles.php">Vehicles</a>
        <a href="tracking.php">Tracking</a>
        <a href="reports.php">Reports</a>
        <a href="schedule.php">Scheduling</a>
    </div>

    <!-- BOTTOM MENU -->
    <div class="bottom-menu">
        <a href="help.php">Help</a><br>
        <a href="logout.php" class="text-danger">Logout</a>
    </div>

</div>

<!-- 🔷 CONTENT -->
<div class="content">
    <h3>Dashboard</h3>

    <div class="row mt-3">
        <div class="col-md-4">
            <div class="card p-3">Total Buses: 10</div>
        </div>
        <div class="col-md-4">
            <div class="card p-3">Active Routes: 5</div>
        </div>
        <div class="col-md-4">
            <div class="card p-3">Alerts: 2</div>
        </div>
    </div>
</div>

<!-- 🔽 SCRIPT -->
<script>
function toggleMenu() {
    let menu = document.getElementById("dropdown");
    menu.style.display = (menu.style.display === "block") ? "none" : "block";
}
</script>

</body>
</html>