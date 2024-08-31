<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $new_password = $_POST['new_password'];

    // Validate the email and new password
    // Implement the logic to update the user's password in the database

    // Set success or error messages and redirect to login page
    $success = "Password reset successfully. Please log in.";
    include 'controllers/login.php';
}