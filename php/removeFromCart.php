<?php
session_start();

if (isset($_SESSION['username'])) {
    $email = $_SESSION['username'];

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $cartID = $_POST['cartID'];
        $quantity = $_POST['quantity'];

        $conn = new mysqli('localhost', 'root', '', 'agrora');

        if ($conn->connect_error) {
            die('Connection Failed : ' . $conn->connect_error);
        } else {
            if ($quantity > 1) {
                $quantity -= 1;
                // Update quantity in the cart
                $stmt = $conn->prepare("UPDATE cart SET quantity = ? WHERE cartID = ?");
                $stmt->bind_param("ii", $quantity, $cartID);

                if ($stmt->execute()) {
                    echo '<script> alert("Item quantity updated in cart!");</script>';
                    echo '<script> window.location.href = "../products.php"; </script>';
                } else {
                    echo "Error updating item quantity in cart: " . $stmt->error;
                }
            } else {
                // Remove the product from the cart if quantity is 1 or less
                $stmt = $conn->prepare("DELETE FROM cart WHERE emailAddress = ? AND cartID = ?");
                $stmt->bind_param("si", $email, $cartID);

                if ($stmt->execute()) {
                    echo '<script> alert("Item removed successfully!");</script>';
                    echo '<script> window.location.href = "../products.php"; </script>';

                } else {
                    echo "Error removing item from cart: " . $stmt->error;
                }
            }

            $stmt->close();
            $conn->close();
        }
    }
} else {
    header("Location: user.php");
}