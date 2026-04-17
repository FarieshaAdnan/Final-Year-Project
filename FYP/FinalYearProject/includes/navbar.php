<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<nav>
    <a href="../../views/user/dashboard.php">Dashboard</a>

    <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
        <a href="../../views/admin/vehicles.php">Manage Vehicles</a>
        <a href="../../views/admin/geofence.php">Geofence</a>
    <?php elseif (isset($_SESSION['role']) && $_SESSION['role'] === 'user'): ?>
        <a href="../../views/user/tracking.php">Tracking</a>
    <?php endif; ?>

    <a href="../../views/admin/vehicles.php">Logout</a>
</nav>