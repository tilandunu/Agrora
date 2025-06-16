<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../styles/Main Page/supplier.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@300&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap" rel="stylesheet" />
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <title>Dashboard</title>
</head>

<body>
    <div id="backgroundDiv">
        <div id="headerdiv">
            <div id="logoutdiv">
                <p id="logoutLabel">LOGOUT</p>
                <span class="material-symbols-outlined" id="logout" onclick="logout()">
                    logout
                </span>
            </div>
            <h2 id="subheader">SUPPLIER</h2>
            <h1 id="header">DASHBOARD</h1>
            <hr />
            <div id="buttondiv">
                <button class="productbutton" id="activebutton" onclick="addButton()">
                    UPDATE STOCK
                </button>
            </div>
        </div>
    </div>

    <?php
    session_start();
    $conn = new mysqli('localhost', 'root', '', 'agrora');

    if ($conn->connect_error) {
        die('Connection Failed: ' . $conn->connect_error);
    }

    if (isset($_GET['stockID'])) {
        $stockID = $_GET['stockID'];

        $stmt = $conn->prepare("SELECT stockID, productName, productPrice, productImage, quantity FROM stock WHERE stockID = ?");
        $stmt->bind_param("i", $stockID);

        if ($stmt->execute()) {
            $result = $stmt->get_result();

            if ($row = $result->fetch_assoc()) {
                // Display a form with pre-filled data for updating
                echo '<div id="addproductsdiv">';
                echo '<form id="addproductsform" method="POST" action="processUpdate.php">';
                echo '<div id="backgroundForm">';
                echo '<input type="hidden" class="formInput" name="stockID" value="' . $row['stockID'] . '">';
                echo '<div class="formcontent">';
                echo '<label class="label"> Product Name: </label>';
                echo '<input class="formInput" type="text" name="productName" value="' . $row['productName'] . '" placeholder="' . $row['productName'] . '"><br>';
                echo '</div>';
                echo '<div class="formcontent">';
                echo '<label class="label"> Product Price: </label>';
                echo '<input class="formInput" type="text" name="productPrice" value="' . $row['productPrice'] . '" placeholder="' . $row['productPrice'] . '"><br>';
                echo '</div>';
                echo '<div class="formcontent">';
                echo '<label class="label"> Quantity: </label>';
                echo '<input class="formInput" type="text" name="quantity" value="' . $row['quantity'] . '" placeholder="' . $row['quantity'] . '"><br>';
                echo '</div>';
                echo '<div id="submitDiv">';
                echo '<input type="submit" id="submit" name="submit" />';
                echo '</div>';
                echo '</div>';
                echo '</form>';
                echo '</div>';
            }
        } else {
            echo "Error fetching product details: " . $stmt->error;
        }

        $stmt->close();
    }

    $conn->close();