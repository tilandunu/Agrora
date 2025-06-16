<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["productID"])) {
    $conn = new mysqli('localhost', 'root', '', 'agrora');

    if ($conn->connect_error) {
        die('Connection Failed: ' . $conn->connect_error);
    }

    $productID = $_POST["productID"];


    $getProductInfoSQL = "SELECT firstName, lastName FROM user WHERE userID = ?";
    $stmtGetProductInfo = $conn->prepare($getProductInfoSQL);
    $stmtGetProductInfo->bind_param("i", $userID);
    $stmtGetProductInfo->execute();
    $stmtGetProductInfo->bind_result($fName, $lName);
    $stmtGetProductInfo->fetch();
    $stmtGetProductInfo->close();

    $sql = "DELETE FROM user WHERE userID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $userID);

    if ($stmt->execute()) {
        echo "Product deleted successfully";
    } else {
        echo "Error deleting product: " . $conn->error;
    }

    $stmt->close();
    $conn->close();

    header("Location: ../deleteUsers.php");
    exit();
}


?>