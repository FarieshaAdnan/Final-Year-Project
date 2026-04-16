<?php
include 'config.php';
include 'layout.php';
$result = $conn->query("SELECT * FROM alerts ORDER BY created_at DESC");
?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<h2>Alerts</h2>

<table border="1">
<tr>
    <th>Bus ID</th>
    <th>Message</th>
    <th>Status</th>
</tr>

<?php while($row = $result->fetch_assoc()) { ?>
<tr>
    <td><?php echo $row['bus_id']; ?></td>
    <td><?php echo $row['message']; ?></td>
    <td><?php echo $row['status']; ?></td>
</tr>
<?php } ?>

</table>