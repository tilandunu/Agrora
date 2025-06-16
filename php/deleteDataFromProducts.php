<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["productNumber"])) {
    $conn = new mysqli('localhost', 'root', '', 'agrora');

    if ($conn->connect_error) {
        die('Connection Failed: ' . $conn->connect_error);
    }

    $productID = $_POST["productNumber"];


    $getProductInfoSQL = "SELECT productName, quantity FROM product WHERE productNumber = ?";
    $stmtGetProductInfo = $conn->prepare($getProductInfoSQL);
    $stmtGetProductInfo->bind_param("i", $productID);
    $stmtGetProductInfo->execute();
    $stmtGetProductInfo->bind_result($pName, $quantity);
    $stmtGetProductInfo->fetch();
    $stmtGetProductInfo->close();

    $sql = "DELETE FROM product WHERE productNumber = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $productID);

    if ($stmt->execute()) {

        $updateInventorySQL = "UPDATE inventory SET remainingStock = remainingStock - ? WHERE productName = ?";
        $stmtUpdateInventory = $conn->prepare($updateInventorySQL);
        $stmtUpdateInventory->bind_param("is", $quantity, $pName);
        $stmtUpdateInventory->execute();

        $removeFromInventorySQL = "DELETE FROM inventory WHERE productName = ? AND remainingStock <= 0";
        $stmtRemoveFromInventory = $conn->prepare($removeFromInventorySQL);
        $stmtRemoveFromInventory->bind_param("s", $pName);
        $stmtRemoveFromInventory->execute();

        echo 'alert("Product deleted successfully!")';
        echo '<script> window.location.href = "../deleteProducts.php"; </script>';
    } else {
        echo "Error deleting product: " . $conn->error;
    }

    $stmt->close();
    $conn->close();

    header("Location: ../deleteProducts.php");
    exit();
}


?>