<?php
session_start();
include 'databd.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.html");
    exit;
}

$user_id = $_SESSION['user_id']; // Get the logged-in user's ID

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $status = $_POST['status'];
    $due_date = $_POST['due_date'];

    // Validate fields
    if (empty($title) || empty($description)) {
        echo "Title and Description are required.";
        exit;
    }

    // Insert into database
    $sql = "INSERT INTO todolist (user_id, title, description, status, due_date) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("issss", $user_id, $title, $description, $status, $due_date);

    if ($stmt->execute()) {
        echo "Task added successfully! <a href='todo.html'>Go back</a>";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
