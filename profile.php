<?php
session_start();
include_once 'templates/header.php'; // Include your header template
?>

<div class="container">
    <div class="row mt-2 mb-2">
        <!-- Sidebar -->
        <div class="col-md-4">
            <?php include_once 'templates/user-sidebar.php'; ?>
        </div>
        <!-- End Sidebar -->

        <!-- Main Content -->
        <div>

        </div>
        <!-- End Main Content -->

    </div>
</div>

<?php include_once 'templates/footer.php'; // Include your footer template ?>
