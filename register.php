<?php
include_once 'config/config.php'; // Include your database configuration file

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Check if passwords match
    if ($password !== $confirm_password) {
        // Passwords do not match
        $alert_message = "Error: Passwords do not match.";
        $alert_class = "alert-danger";
    } else {

        // Check if the email already exists in the database
        $check_email_query = "SELECT * FROM users WHERE email_id = '$email'";
        $check_email_result = mysqli_query($conn, $check_email_query);

        if (mysqli_num_rows($check_email_result) > 0) {
            // Email already exists
            $alert_message = "Error: Email already exists.";
            $alert_class = "alert-danger";
        } else {

            // Hash the password for security
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // Insert user data into the database
            $query = "INSERT INTO users (first_name, last_name, email_id, password) VALUES ('$first_name', '$last_name', '$email', '$hashed_password')";

            if (mysqli_query($conn, $query)) {
                
                // Retrieve the user ID of the newly registered user
                $query = "SELECT userid FROM users WHERE email_id = '$email'";
                $result = mysqli_query($conn, $query);

                if ($result && mysqli_num_rows($result) > 0) {
                    $row = mysqli_fetch_assoc($result);
                    $user_id = $row['userid'];
                    
                    // Insert the user ID into the bank_accounts table
                    $insert_query = "INSERT INTO bank_accounts (user_id) VALUES ('$user_id')";
                    
                    if (mysqli_query($conn, $insert_query)) {
                        // User registration successful
                        $alert_message = "User registration successful.";
                        $alert_class = "alert-success";
                    } else {
                        // User registration failed
                        $alert_message = "User registration failed.";
                        $alert_class = "alert-danger";
                    }
                } else {
                    // Error retrieving user ID
                    $alert_message = "Error retrieving user ID.";
                    $alert_class = "alert-danger";
                }

            } else {
                $alert_message = "Error: " . $query . "<br>" . mysqli_error($conn);
                $alert_class = "alert-danger";
            }

        }

        
    }
} else {
    // Redirect to the registration page if accessed directly
    // header("Location: register.php");
}
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EasyPay Mobile Banking</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="css/style.css" rel="stylesheet">
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container">
                <a class="navbar-brand" href="#">EasyPay Mobile Banking Application</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="index.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="login.php">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="register.php">Register</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <div class="container">
        <div class="row mt-2 mb-2">
            <div class="offset-3 col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h2 class="text-center">Register Here</h2>
                    </div>
                    <div class="card-body">
<?php if (!empty($alert_message)): ?>
<div class="alert <?php echo $alert_class; ?>" role="alert">
    <?php echo $alert_message; ?>
</div>
<?php endif; ?>                        
                        <form action="register.php" method="POST">
                            <div class="form-group">
                                <label for="first_name">First Name:</label>
                                <input type="text" class="form-control" id="first_name" name="first_name" required>
                            </div>
                            <div class="form-group">
                                <label for="last_name">Last Name:</label>
                                <input type="text" class="form-control" id="last_name" name="last_name" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Password:</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <div class="form-group">
                                <label for="confirm_password">Confirm Password:</label>
                                <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
                            </div>
                            <button type="submit" class="btn btn-primary float-right">Register</button>
                        </form>                        
                    </div>
                </div>               
            </div>
        </div>
    </div>
    <footer class="footer mt-auto py-3 bg-dark">
        <div class="container text-center">
            <span class="text-muted">EasyPay Mobile Application &copy; <?php echo date("Y"); ?></span>
        </div>
    </footer>
    <!-- Bootstrap JS and jQuery (optional) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- Custom JS -->
    <script src="js/script.js"></script>
</body>
</html>




