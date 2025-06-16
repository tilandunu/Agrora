<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.php"); // Redirect to your login page if not logged in
    exit();
}

if (isset($_GET['stockID'])) {
    // Get the stock ID from the URL
    $stockID = $_GET['stockID'];

    // Establish a database connection
    $conn = new mysqli('localhost', 'root', '', 'agrora');

    if ($conn->connect_error) {
        die('Connection Failed: ' . $conn->connect_error);
    } else {
        // Prepare a SQL statement to delete the record
        $stmt = $conn->prepare("DELETE FROM stock WHERE stockID = ?");
        $stmt->bind_param("i", $stockID);

        if ($stmt->execute()) {
            // Record deleted successfully, you can redirect the user to a success page
            header("Location: ../viewAndEditStock.php");
        } else {
            // Error occurred during deletion
            echo "Error deleting record: " . $stmt->error;
        }

        $stmt->close();
        $conn->close();
    }
} else {
    echo "Invalid stock ID.";
}
