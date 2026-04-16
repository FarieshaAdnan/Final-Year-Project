<?php include 'layout.php'; include 'config.php';

$id = $_GET['id'];
$data = $conn->query("SELECT * FROM vehicles WHERE id=$id")->fetch_assoc();
?>

<div class="content">

<h3>Edit Vehicle</h3>

<form action="update_vehicle.php" method="POST">

<input type="hidden" name="id" value="<?= $data['id'] ?>">

<input name="bus_id" value="<?= $data['bus_id'] ?>" class="form-control mb-2">
<input name="plate" value="<?= $data['plate_number'] ?>" class="form-control mb-2">
<input name="driver" value="<?= $data['driver_name'] ?>" class="form-control mb-2">
<input name="route" value="<?= $data['route'] ?>" class="form-control mb-2">

<button class="btn btn-dark">Update</button>

</form>

</div>