<?php
session_start();
$conn = new mysqli('localhost', 'root', '', 'agrora');

if ($conn->connect_error) {
    die('Connection Failed : ' . $conn->connect_error);
} else {
    $email = $_SESSION['username'];

    $stmt_select = $conn->prepare("SELECT * FROM stock WHERE emailAddress = ?");
    $stmt_select->bind_param("s", $email);

    if ($stmt_select->execute()) {
        $result = $stmt_select->get_result();

        if (!isset($_SESSION['supplierStockNumber'])) {
            $_SESSION['supplierStockNumber'] = 1;
        } else {
            $_SESSION['supplierStockNumber']++;
        }

        while ($row = $result->fetch_assoc()) {
            $stmt_insert = $conn->prepare("INSERT INTO adminStock (supplierStockNumber, emailAddress, productName, productPrice, productCategory, productImage, quantity) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $stmt_insert->bind_param("ssssssi", $_SESSION['supplierStockNumber'], $email, $row['productName'], $row['productPrice'], $row['productCategory'], $row['productImage'], $row['quantity']);

            if ($stmt_insert->execute()) {

                $stmt_delete = $conn->prepare("DELETE FROM stock WHERE emailAddress = ?");
                $stmt_delete->bind_param("s", $email);
                $stmt_delete->execute();

                echo '<script> alert("Data sent to admin successfully");</script>';
                echo '<script> window.location.href = "../addToStock.html"; </script>';
            } else {
                echo '<script>alert("Failed to send data to admin");</script>';
            }
        }
    } else {
        echo "Error fetching stock items: " . $stmt_select->error;
    }

    $stmt_select->close();
    $conn->close();
}
