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
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h2 class="text-center">Upload Profile Image</h2>
                </div>
                <div class="card-body">
<!-- Display success message alert box if set -->
<?php if (isset($_SESSION['success_message'])) { ?>
    <div class="alert alert-success" role="alert">
        <?php echo $_SESSION['success_message']; ?>
    </div>
    <?php unset($_SESSION['success_message']); // Unset success message to prevent displaying it again on page reload ?>
<?php } ?>

<!-- Display error message alert box if set -->
<?php if (isset($_SESSION['error_message'])) { ?>
    <div class="alert alert-danger" role="alert">
        <?php echo $_SESSION['error_message']; ?>
    </div>
    <?php unset($_SESSION['error_message']); // Unset error message to prevent displaying it again on page reload ?>
<?php } ?>                    
                    <form action="upload_profile_image_backend.php" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="profile_image">Choose Profile Image:</label>
                            <input type="file" class="form-control-file" id="profile_image" name="profile_image" accept="image/*" required>
                        </div>
                        <button type="submit" class="btn btn-primary float-right">Upload</button>
                    </form>
                </div>
            </div>
        </div>
        <!-- End Main Content -->

    </div>
</div>

<?php include_once 'templates/footer.php'; // Include your footer template ?>
