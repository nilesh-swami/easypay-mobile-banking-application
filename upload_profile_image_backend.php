<?php
session_start();
include_once 'config/config.php'; // Include your database configuration file

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if a file was selected for upload
    if (isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] === UPLOAD_ERR_OK) {
        // Specify upload directory
        $upload_dir = 'uploads/';
        
        // Generate a unique filename for the uploaded file
        $file_name = uniqid() . '_' . $_FILES['profile_image']['name'];
        
        // Move the uploaded file to the upload directory
        if (move_uploaded_file($_FILES['profile_image']['tmp_name'], $upload_dir . $file_name)) {
            // File upload successful, store the file path in the database
            $user_email = $_SESSION['user_email'];
            $file_path = $upload_dir . $file_name;
            
            // Update the user's profile image path in the database
            $update_query = "UPDATE users SET user_img = '$file_path' WHERE email_id = '$user_email'";
            if (mysqli_query($conn, $update_query)) {
                // Profile image path updated successfully
                $_SESSION['success_message'] = "Profile image uploaded successfully!";
            } else {
                // Error updating profile image path in the database
                $_SESSION['error_message'] = "Error updating profile image path: " . mysqli_error($conn);
            }
        } else {
            // Error moving uploaded file to the server
            $_SESSION['error_message'] = "Error uploading file.";
        }
    } else {
        // No file selected for upload or file upload error occurred
        $_SESSION['error_message'] = "No file selected or file upload error occurred.";
    }
}

// Redirect back to the upload profile image page
header("Location: upload_profile_image.php");
exit();
?>
