<?php
include(__DIR__ . '/../includes/header.php');
include(__DIR__ . '/../includes/navbar.php');
?>

<div class="container-fluid">
    <div class="row">

        <!-- SIDEBAR -->
        <div class="col-md-2 p-0">
            <?php include(__DIR__ . '/../includes/sidebar.php'); ?>
        </div>

        <!-- MAIN CONTENT -->
        <div class="col-md-10 p-4">

            <?php
            if (isset($page_content)) {
                include($page_content);
            }
            ?>

        </div>

    </div>
</div>

<?php include(__DIR__ . '/../includes/footer.php'); ?>