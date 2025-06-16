<?php
session_start();
$conn = new mysqli('localhost', 'root', '', 'agrora');

if ($conn->connect_error) {
    die('Connection Failed: ' . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $stockID = $_POST['stockID'];
    $productName = $_POST['productName'];
    $productPrice = $_POST['productPrice'];
    $productImage = $_POST['productImage'];
    $quantity = $_POST['quantity'];

    $stmt = $conn->prepare("UPDATE stock SET productName=?, productPrice=?, productImage=?, quantity=? WHERE stockID=?");
    $stmt->bind_param("ssssi", $productName, $productPrice, $productImage, $quantity, $stockID);

    if ($stmt->execute()) {
        echo '<script> alert("Updated successfully!");</script>';
        echo '<script> window.location.href = "../viewAndEditStock.php"; </script>';
    } else {
        echo "Error updating product: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
