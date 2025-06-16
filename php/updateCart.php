<?php
session_start();

if (isset($_SESSION['username'])) {
    $email = $_SESSION['username'];

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $cartID = $_POST['cartID'];
        $newQuantity = $_POST['quantity'];

        if ($cartID > 0 && $newQuantity >= 1) {
            $conn = new mysqli('localhost', 'root', '', 'agrora');

            if ($conn->connect_error) {
                die('Connection Failed : ' . $conn->connect_error);
            } else {
                $stmt = $conn->prepare("UPDATE cart SET quantity = ? WHERE cartID = ? AND emailAddress = ?");
                $stmt->bind_param("iis", $newQuantity, $cartID, $email);

                if ($stmt->execute()) {
                    echo '<script>alert("Quantity updated successfully!");</script>';
                    echo '<script> window.location.href = "../products.php"; </script>';
                } else {
                    echo "Error updating quantity: " . $stmt->error;
                }

                $stmt->close();
                $conn->close();
            }
        }
    }
}