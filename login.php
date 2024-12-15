<?php
session_start();
include 'databd.php';

// If user is already logged in, redirect to home
if (isset($_SESSION['user_id'])) {
    header("Location: home.html");
    exit;
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve form inputs
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    // Check if the user exists
    $stmt = $conn->prepare("SELECT id, name, password FROM users WHERE email = ?");
    if ($stmt === false) {
        die("Prepare failed: " . $conn->error);
    }

    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    // Verify if the user exists
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $name, $hashed_password);
        $stmt->fetch();

        // Verify the password
        if (password_verify($password, $hashed_password)) {
            // Store user data in session
            $_SESSION['user_id'] = $id;
            $_SESSION['user_name'] = $name;

            // Redirect to home page
            header("Location: home.html");
            exit;
        } else {
            echo "Invalid password.";
        }
    } else {
        echo "No user found with this email.";
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
} else {
    // Show the login form if not submitted
    include 'signin.html';
}
?>
