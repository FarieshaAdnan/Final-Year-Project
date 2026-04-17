<?php
session_start();
if ($_SESSION['role'] != 'admin') {
    header("Location: ../../index.php");
    exit();
}

include('../../includes/header.php');
include('../../includes/navbar.php');
include('../../modules/vehicle/vehicle_model.php');

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $bus_id = $_POST['bus_id'];
    $plate = $_POST['plate_number'];
    $driver = $_POST['driver_name'];

    addVehicle($conn, $bus_id, $plate, $driver);
}
?>

<h2>Manage Vehicles</h2>

<!-- Add Vehicle Form -->
<form method="POST">
    <input type="text" name="bus_id" placeholder="Bus ID" required><br><br>
    <input type="text" name="plate_number" placeholder="Plate Number" required><br><br>
    <input type="text" name="driver_name" placeholder="Driver Name" required><br><br>
    <button type="submit">Add Vehicle</button>
</form>

<hr>

<h3>Vehicle List</h3>

<?php
$result = getVehicles($conn);
while ($row = mysqli_fetch_assoc($result)) {
?>
    <div>
        <?php echo $row['bus_id']; ?> -
        <?php echo $row['plate_number']; ?> -
        <?php echo $row['driver_name']; ?>

        <a href="?delete=<?php echo $row['id']; ?>">Delete</a>
    </div>
<?php } ?>

<?php
// Handle delete
if (isset($_GET['delete'])) {
    deleteVehicle($conn, $_GET['delete']);
    header("Location: vehicles.php");
}
?>

<?php include('../../includes/footer.php'); ?>