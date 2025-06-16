<?php
session_start();

if (isset($_POST['submit'])) {
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    $email = $_SESSION['username'];

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $pName = $_POST['productName'];
        $pPrice = $_POST['productPrice'];
        $category = $_POST['productCategory'];
        $quantityP = $_POST['quantity'];
    }

    $conn = new mysqli('localhost', 'root', '', 'agrora');

    if ($conn->connect_error) {
        die('Connection Failed : ' . $conn->connect_error);
    } else {
        $stmt = $conn->prepare("INSERT INTO stock (`emailAddress`, `productName`, `productPrice`, `productCategory`,  `quantity`) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("ssdsd", $email, $pName, $pPrice, $category, $quantityP);

        if ($stmt->execute()) {
            echo '<script> alert("Item added successfully");</script>';
            echo '<script> window.location.href = "../addToStock.html"; </script>';
        } else {
            echo '<script>alert("Failed to add item");</script>';
        }

        $stmt->close();
        $conn->close();
    }
}