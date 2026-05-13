<h2 class="mb-4">🚍 Manage Vehicles</h2>

<!-- ADD VEHICLE CARD -->
<div class="card shadow-sm p-4 mb-4">

    <h5 class="mb-3">Add New Vehicle</h5>

    <form method="POST">

        <div class="row">

            <div class="col-md-4 mb-3">
                <label class="form-label">Bus ID</label>

                <input type="text"
                       name="bus_id"
                       class="form-control"
                       required>
            </div>

            <div class="col-md-4 mb-3">
                <label class="form-label">Plate Number</label>

                <input type="text"
                       name="plate_number"
                       class="form-control"
                       required>
            </div>

            <div class="col-md-4 mb-3">
                <label class="form-label">Driver Name</label>

                <input type="text"
                       name="driver_name"
                       class="form-control"
                       required>
            </div>

        </div>

        <button type="submit"
                class="btn btn-danger">

            Add Vehicle

        </button>

    </form>

</div>

<!-- VEHICLE TABLE -->
<div class="card shadow-sm p-4">

    <h5 class="mb-3">Vehicle List</h5>

    <div class="table-responsive">

        <table class="table table-hover align-middle">

            <thead class="table-dark">

                <tr>
                    <th>ID</th>
                    <th>Bus ID</th>
                    <th>Plate Number</th>
                    <th>Driver</th>
                    <th>Action</th>
                </tr>

            </thead>

            <tbody>

            <?php

            $result = getVehicles($conn);

            while ($row = mysqli_fetch_assoc($result)) {

            ?>

                <tr>

                    <td><?= $row['id']; ?></td>

                    <td><?= $row['bus_id']; ?></td>

                    <td><?= $row['plate_number']; ?></td>

                    <td><?= $row['driver_name']; ?></td>

                    <td>

                        <a href="?delete=<?= $row['id']; ?>"
                           class="btn btn-sm btn-danger"
                           onclick="return confirm('Delete this vehicle?')">

                            Delete

                        </a>

                    </td>

                </tr>

            <?php } ?>

            </tbody>

        </table>

    </div>

</div>