<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<?php
session_start();

if ($_SESSION['role'] != 'admin') {
    header("Location: /index.php");
    exit();
}

include('../../config/db.php');
$page_content = 'dashboard_content.php';
include('../../includes/header.php');
include('../../layouts/admin_layout.php');
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <title>Admin Dashboard</title>
    <style>
        body {
            background-color: #F5EBDD;
        }

        .navbar {
            background: white;
            border-radius: 10px;
            margin: 15px;
            padding: 10px 20px;
        }

        .card {
            border-radius: 15px;
        }

        .chart-box {
            height: 200px;
            background: #f1f1f1;
            border-radius: 10px;
        }
    </style>
  </head>
  <body>

 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
  </body>
  </html>