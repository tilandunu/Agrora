<?php
session_start();

if (isset($_POST['submit'])) {
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $slug = $_POST['slug'];
        $pName = $_POST['productName'];
        $pPrice = $_POST['productPrice'];
        $category = $_POST['productCategory'];
        $image = $_POST['productImage'];
        $quantityP = $_POST['quantity'];
    }

    $conn = new mysqli('localhost', 'root', '', 'agrora');

    if ($conn->connect_error) {
        die('Connection Failed : ' . $conn->connect_error);
    } else {
        $stmt = $conn->prepare("INSERT INTO product (`slug`, `productName`, `productPrice`, `productCategory`, `productImage`, `quantity`) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssdssd", $slug, $pName, $pPrice, $category, $image, $quantityP);

        if ($stmt->execute()) {
            $check_stmt = $conn->prepare("SELECT * FROM inventory WHERE productName = ?");
            $check_stmt->bind_param("s", $pName);
            $check_stmt->execute();
            $result = $check_stmt->get_result();

            if ($result->num_rows > 0) {
                $update_stmt = $conn->prepare("UPDATE inventory SET remainingStock = remainingStock + ?, productPrice = ?, productImage = ?, productCategory = ? WHERE productName = ?");
                $update_stmt->bind_param("dssss", $quantityP, $pPrice, $image, $category, $pName);
                if ($update_stmt->execute()) {
                    $_SESSION['productadded'] = true;
                    $_SESSION['productNumber'] = $pNumber;
                    echo '<script> alert("Quantity updated successfully!"); </script>';
                    echo '<script> window.location.href = "../productManagement.php"; </script>';
                    exit();
                } else {
                    echo "Error updating quantity: " . $update_stmt->error;
                }
            } else {
                $insert_stmt = $conn->prepare("INSERT INTO inventory (productName, remainingStock, slug, productPrice, productImage, productCategory) VALUES (?, ?, ?, ?, ?, ?)");
                $insert_stmt->bind_param("sdssss", $pName, $quantityP, $slug, $pPrice, $image, $category);
                if ($insert_stmt->execute()) {
                    $_SESSION['productadded'] = true;
                    $_SESSION['productNumber'] = $pNumber;
                    echo '<script> alert("Added successfully!"); </script>';
                    echo '<script> window.location.href = "../productManagement.php"; </script>';
                    exit();
                } else {
                    echo "Error inserting product into inventory: " . $insert_stmt->error;
                }
            }
        } else {
            echo "Error inserting product into product table: " . $stmt->error;
        }

        $stmt->close();
        $check_stmt->close();
        $conn->close();
    }
}
?>