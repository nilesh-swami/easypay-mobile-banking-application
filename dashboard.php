<?php
session_start();
include_once 'config/config.php'; // Include your database configuration file

// Check if user is logged in
if (!isset($_SESSION['user_email'])) {
    // Redirect to login page if not logged in
    header("Location: login.php");
    exit(); // Stop further script execution
}
?>

<?php
    $profile_image = "";
    // Fetch user's profile image path from the database
    $user_email = $_SESSION['user_email'];
    $query = "SELECT user_img FROM users WHERE email_id = '$user_email'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $profile_image = $row['user_img'];
    } else {
        // Default profile image path if user's image not found
        $profile_image = "default_profile_image.jpg";
    }

    // Display profile image
?>

<?php include_once 'templates/header.php'; ?>

<div class="container mt-5">
    <div class="jumbotron">
        <div class="row mt-2 mb-2">
            <div class="col-md-4">
                <!-- Profile Image -->
                <div class="col-md-4">
                    <div class="profile-image-container">
                        <img src="<?php echo $profile_image; ?>" class="rounded-circle" width="250" height="250" alt="Profile Image">
                    </div>
                </div>
                <!-- End Profile Image -->
            </div>
            <div class="col-md-8">
                <h1 class="display-4">Welcome, <?php echo $_SESSION['user_firstname'] . ' ' . $_SESSION['user_lastname']; ?>!</h1>
                <p class="lead">This is your dashboard.</p>
                <hr class="my-4">
                <p>Here you can manage your account and access various features.</p>
                <a class="btn btn-primary btn-lg" href="logout.php" role="button">Logout</a>                
            </div>
        </div>
    </div>

    <div class="row mt-2 mb-2">
        <div class="col-md-4 mb-4">
            <div class="card">
                <img src="images/tick-icon.png" class="card-img-top" alt="Image 1">
                <div class="card-body">
                    <h5 class="card-title">Add Bank Account</h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>

                    <a href="add_bank_account.php" class="btn btn-outline-primary btn-block">Click here</a>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card">
                <img src="images/tick-icon.png" class="card-img-top" alt="Image 1">
                <div class="card-body">
                    <h5 class="card-title">Check Balance</h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>

                    <a href="add_bank_account.php" class="btn btn-outline-primary btn-block">Click here</a>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card">
                <img src="images/tick-icon.png" class="card-img-top" alt="Image 1">
                <div class="card-body">
                    <h5 class="card-title">Send Money</h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>

                    <a href="add_bank_account.php" class="btn btn-outline-primary btn-block">Click here</a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include_once 'templates/footer.php'; ?>





