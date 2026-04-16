<?php 
include 'layout.php'; 
include 'config.php'; 
?>
<head>
    <title>Vehicles Management</title>
</head>
<body>
<div class="content">

<h3>Vehicles Management</h3>

<!-- ➕ ADD BUTTON -->
<button class="btn btn-dark mb-3" data-bs-toggle="modal" data-bs-target="#addModal">
    + Add Vehicle
</button>

<!-- 📋 TABLE -->
<table class="table table-bordered bg-white">
    <tr>
        <th>Bus ID</th>
        <th>Plate</th>
        <th>Driver</th>
        <th>Route</th>
        <th>Status</th>
        <th>Action</th>
    </tr>

<?php
$result = $conn->query("SELECT * FROM vehicles");

while($row = $result->fetch_assoc()){
?>
<tr>
    <td><?= $row['bus_id'] ?></td>
    <td><?= $row['plate_number'] ?></td>
    <td><?= $row['driver_name'] ?></td>
    <td><?= $row['route'] ?></td>
    <td><?= $row['status'] ?></td>

    <td>
        <a href="edit_vehicle.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-warning">Edit</a>
        <a href="delete_vehicle.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-danger">Delete</a>
    </td>
</tr>
<?php } ?>

</table>

</div>

<!-- ADD MODAL -->
<div class="modal fade" id="addModal">
<div class="modal-dialog">
<div class="modal-content p-3">

<form action="add_vehicle.php" method="POST">

<input name="bus_id" class="form-control mb-2" placeholder="Bus ID" required>
<input name="plate" class="form-control mb-2" placeholder="Plate Number">
<input name="driver" class="form-control mb-2" placeholder="Driver Name">
<input name="route" class="form-control mb-2" placeholder="Route">
<select name="status" class="form-control mb-2">
    <option>Active</option>
    <option>Inactive</option>
</select>

<button class="btn btn-dark w-100">Save</button>

</form>

</div>
</div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>