<?php
if (isset($_POST['stockNumber'])) {
    // Get the stock number from the form submission
    $stockNumber = $_POST['stockNumber'];

    // Update the status in the database
    $conn = new mysqli('localhost', 'root', '', 'agrora');

    if ($conn->connect_error) {
        die('Connection Failed : ' . $conn->connect_error);
    }

    $sql = "UPDATE adminStock SET status = 'completed' WHERE stockNumber = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $stockNumber);

    if ($stmt->execute()) {
        echo '<script>"alert(Status changed to Completed)";</script>';
        echo '<script> window.location.href = "../viewActiveOrders.php"; </script>';
    } else {
        // Error occurred during the update
        echo "Error updating status: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
} else {
    echo "Invalid request.";
}
