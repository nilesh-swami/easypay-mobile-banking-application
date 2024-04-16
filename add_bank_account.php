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
                    <h2 class="text-center">Add New Bank Account</h2>
                </div>
                <div class="card-body">
                    <form action="add_bank_account_backend.php" method="POST">
                        <div class="form-group">
                            <label for="bank_name">Bank Name:</label>
                            <input type="text" class="form-control" id="bank_name" name="bank_name" required>
                        </div>
                        <div class="form-group">
                            <label for="account_number">Account Number:</label>
                            <input type="text" class="form-control" id="account_number" name="account_number" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Add Account</button>
                    </form>                    
                </div>
            </div>
        </div>
        <!-- End Main Content -->

    </div>
</div>

<?php include_once 'templates/footer.php'; // Include your footer template ?>
