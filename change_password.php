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

        <!-- Main content -->
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h2 class="text-center">Update Password</h2>
                </div>
                <div class="card-body">
                    <form action="change_password.php" method="POST">
                        <div class="form-group">
                            <label for="old_password">Old Password:</label>
                            <input type="password" class="form-control" id="old_password" name="old_password" required>
                        </div>
                        <div class="form-group">
                            <label for="new_password">New Password:</label>
                            <input type="password" class="form-control" id="new_password" name="new_password" required>
                        </div>
                        <button type="submit" class="btn btn-primary float-right">Change Password</button>
                    </form>
                </div>
            </div>
        </div>
        <!-- End Main content -->
    </div>
</div>

<?php include_once 'templates/footer.php'; // Include your footer template ?>


<?php
include_once 'config/config.php'; // Include your database configuration file

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $old_password = $_POST['old_password'];
    $new_password = $_POST['new_password'];

    // Retrieve user data from the database based on email
    $email = $_SESSION['user_email'];
    $query = "SELECT * FROM users WHERE email_id = '$email'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        if (password_verify($old_password, $row['password'])) {
            // Old password is correct, update the password
            $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
            $update_query = "UPDATE users SET password = '$hashed_password' WHERE email_id = '$email'";
            if (mysqli_query($conn, $update_query)) {
                // Password changed successfully, destroy session and redirect to login page
                session_unset(); // Unset all of the session variables
                session_destroy(); // Destroy the session
                header("Location: login.php"); // Redirect to login page
                exit(); // Stop further script execution
            } else {
                // Error updating password
                $_SESSION['error_message'] = "Error updating password: " . mysqli_error($conn);
                header("Location: profile.php"); // Redirect to profile page
                exit(); // Stop further script execution
            }
        } else {
            // Old password is incorrect
            $_SESSION['error_message'] = "Error: Incorrect old password.";
            header("Location: profile.php"); // Redirect to profile page
            exit(); // Stop further script execution
        }
    } else {
        // User not found
        $_SESSION['error_message'] = "Error: User not found.";
        header("Location: profile.php"); // Redirect to profile page
        exit(); // Stop further script execution
    }
}
?>
