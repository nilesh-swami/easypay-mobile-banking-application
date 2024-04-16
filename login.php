<?php
session_start();
include_once 'templates/header.php'; // Include your header template
?>

<?php include_once 'templates/header.php'; ?>

    <div class="container">
        <div class="row mt-2 mb-2">
            <div class="offset-3 col-md-6">
                <div class="card">                    
                    <div class="card-header">
                        <h2 class="text-center">Login Here</h2>
                    </div>
                    <div class="card-body">
                    <?php
// Display success message alert box if set
if (isset($_SESSION['success_message'])) {
    ?>
    <div class="alert alert-success" role="alert">
        <?php echo $_SESSION['success_message']; ?>
    </div>
    <?php
    unset($_SESSION['success_message']); // Unset success message to prevent displaying it again on page reload
}
// Display error message alert box if set
if (isset($_SESSION['error_message'])) {
    ?>
    <div class="alert alert-danger" role="alert">
        <?php echo $_SESSION['error_message']; ?>
    </div>
    <?php
    unset($_SESSION['error_message']); // Unset error message to prevent displaying it again on page reload
}
?>                        
                        <form action="login.php" method="POST">
                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Password:</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <button type="submit" class="btn btn-primary float-right">Login</button>
                        </form>
                    </div>
                </div>               
            </div>
        </div>
    </div>

    
<?php include_once 'templates/footer.php'; ?>


<?php
include_once 'config/config.php'; // Include your database configuration file

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Retrieve user data from the database based on email
    $query = "SELECT * FROM users WHERE email_id = '$email'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        if (password_verify($password, $row['password'])) {
            // Password is correct, log in the user
            $_SESSION['user_email'] = $email; // Store user email in session
            $_SESSION['user_firstname'] = $row['first_name']; // Store user first name in session
            $_SESSION['user_lastname'] = $row['last_name'];
            $_SESSION['success_message'] = "Login successful!"; // Store success message in session
            header("Location: dashboard.php"); // Redirect to dashboard
            exit(); // Stop further script execution
        } else {
            // Password is incorrect
            $_SESSION['error_message'] = "Error: Incorrect password.";
        }
    } else {
        // User with given email not found
        $_SESSION['error_message'] = "Error: User not found.";
    }
    header("Location: login.php"); // Redirect to login page
    exit(); // Stop further script execution
}
?>

