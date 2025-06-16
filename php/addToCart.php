<?php
session_start();

if (isset($_SESSION['username'])) {
    $email = $_SESSION['username'];

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $productName = $_POST['productName'];
        $productPrice = $_POST['productPrice'];
        $productImage = $_POST['productImage'];

        $conn = new mysqli('localhost', 'root', '', 'agrora');

        if ($conn->connect_error) {
            die('Connection Failed : ' . $conn->connect_error);
        } else {
            $stmt = $conn->prepare("SELECT cartID, quantity FROM cart WHERE emailAddress = ? AND productName = ?");
            $stmt->bind_param("ss", $email, $productName);


            if ($stmt->execute()) {
                $result = $stmt->get_result();

                if ($result->num_rows > 0) {
                    // Product already in cart, update the quantity
                    $row = $result->fetch_assoc();
                    $cartID = $row['cartID'];
                    $quantity = $row['quantity'] + 1;

                    $stmt = $conn->prepare("UPDATE cart SET quantity = ? WHERE cartID = ?");
                    $stmt->bind_param("ii", $quantity, $cartID);

                    if ($stmt->execute()) {
                        echo '<script> alert ("Product added to cart successfully!"); </script>';
                        echo '<script> window.location.href = "../products.php" </script>';
                    } else {
                        echo "Error adding product to cart: " . $stmt->error;
                    }
                } else {
                    // Product not in cart, insert a new row
                    $stmt = $conn->prepare("INSERT INTO cart (emailAddress, productName, productPrice, productImage, quantity) VALUES (?, ?, ?, ?, 1)");
                    $stmt->bind_param("ssds", $email, $productName, $productPrice, $productImage);
                    if ($stmt->execute()) {
                        echo '<script> alert ("Product added to cart successfully!"); </script>';
                        echo '<script> window.location.href = "../products.php" </script>';
                    } else {
                        echo "Error adding product to cart: " . $stmt->error;
                    }
                }
            } else {
                echo "Error checking product in cart: " . $stmt->error;
            }

            $stmt->close();
            $conn->close();
        }
    }
}