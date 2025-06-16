<?php
session_start();

if (isset($_SESSION['username'])) {
    $email = $_SESSION['username'];

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $paymentMethod = $_POST['paymentMethod'];
        $cardNumber = $_POST['cardNumber'] ?? null;
        $cardExpireDate = $_POST['cardExpireDate'] ?? null;
        $cardSecurityCode = $_POST['cardSecurityCode'] ?? null;

        $totalPrice = $_SESSION['totalPrice'];

        $conn = new mysqli('localhost', 'root', '', 'agrora');
        if ($conn->connect_error) {
            die('Connection Failed: ' . $conn->connect_error);
        }

        $stmt = $conn->prepare("SELECT postalAddress FROM user WHERE emailAddress = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->bind_result($postalAddress);
        $stmt->fetch();
        $stmt->close();

        $stmt = $conn->prepare("INSERT INTO orders (emailAddress, totalPrice, paymentMethod, cardNumber, cardExpireDate, cardSecurityCode, postalAddress) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sissiis", $email, $totalPrice, $paymentMethod, $cardNumber, $cardExpireDate, $cardSecurityCode, $postalAddress);

        if ($stmt->execute()) {
            $stmt = $conn->prepare("DELETE FROM cart WHERE emailAddress = ?");
            $stmt->bind_param("s", $email);

            if ($stmt->execute()) {
                echo '<script> alert ("Order placed successfully!"); </script>';
                echo '<script> window.location.href = "../finalOrder.html" </script>';
            } else {
                echo "Order placed successfully, but there was an error deleting cart data: " . $stmt->error;
            }
        } else {
            echo "Error placing order: " . $stmt->error;
        }

        $stmt->close();
        $conn->close();
    } else {
        echo "Invalid request.";
    }
} else {
    header("Location: php/user.php");
}
