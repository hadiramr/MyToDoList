<?php
session_start(); // Start session to use $_SESSION variables
include 'databd.php'; 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve form data
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    // Validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format.";
        exit;
    }

    // Check if email already exists
    $check_email = $conn->prepare("SELECT id FROM users WHERE email = ?");
    $check_email->bind_param("s", $email);
    $check_email->execute();
    $check_email->store_result();

    if ($check_email->num_rows > 0) {
        echo "Email already exists.";
        $check_email->close();
        exit;
    }
    $check_email->close();

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Insert user data into the database
    $stmt = $conn->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
    if ($stmt === false) {
        die("Prepare failed: " . $conn->error);
    }
    $stmt->bind_param("sss", $username, $email, $hashed_password);

    if ($stmt->execute()) {
        $_SESSION['user_id'] = $conn->insert_id; // Store user ID in session
        $_SESSION['user_name'] = $username;

        // Redirect to home.html
        header("Location: home.html");
        exit;
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
} else {
    // Include the HTML form if the request method is GET
    include 'signup.html';
}
?>
