<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="styles/Main Page/productManagement.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@300&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@200&display=swap" rel="stylesheet">
    <title>Document</title>
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
            <a href="admin.php" class="navbuttons"><span class="material-symbols-outlined" id="navbutton1">
                    arrow_back_ios_new
                </span></a>
            <div id="selectionbuttonsdiv">
                <button class="selectionbuttons" onclick="addproducts()">
                    ADD PRODUCTS
                </button>
                <button class="selectionbuttons" onclick="viewproducts()"> VIEW PRODUCTS</button>
                <button class="selectionbuttons" onclick="deleteproducts()">DELETE PRODUCTS</button>
            </div>

            <div id="addproductsdiv">
                <div id="activeOrderDiv">
                    <div id="viewproductsdiv">
                        <table id="productTable">
                            <tr id="productTitle">
                                <th> STOCK NUMBER </th>
                                <th> Email Address </th>
                                <th> Product Name </th>
                                <th> Product Price </th>
                                <th> Product Catergory </th>
                                <th> Quantity </th>
                                <th> STATUS </th>
                                <th> </th>
                            </tr>

                            <?php
                            // Connect to the database
                            $conn = new mysqli('localhost', 'root', '', 'agrora');

                            if ($conn->connect_error) {
                                die('Connection Failed : ' . $conn->connect_error);
                            }

                            // Query to fetch product data
                            $sql = "SELECT `stockNumber`, `emailAddress`, `productName`, `productPrice`, `productCategory`, `quantity`, `status` FROM adminStock WHERE `status` = 'active'";;
                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo "<tr>";
                                    echo "<td>" . $row["stockNumber"] . "</td>";
                                    echo "<td>" . $row["emailAddress"] . "</td>";
                                    echo "<td>" . $row["productName"] . "</td>";
                                    echo "<td>" . $row["productPrice"] . "</td>";
                                    echo "<td>" . $row["productCategory"] . "</td>";
                                    echo "<td>" . $row["quantity"] . "</td>";
                                    echo "<td>" . $row["status"] . "</td>"; // Display the status
                                    echo '<td><form method="post" action="php/updateStatusAdmin.php">
                                    <input type="hidden" name="stockNumber" value="' . $row["stockNumber"] . '">
                                    <input type="submit" value="Change Status" onclick="return confirm(\'Are you sure you want to change the status?\')"></form></td>'; // Add a form to submit the stock number to updateStatus.php
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td colspan='5'>No products found</td></tr>";
                            }

                            $conn->close();
                            ?>
                        </table>
                    </div>
                </div>
            </div>
</body>

</html>


</table>
</div>

<script>
    function addproducts() {
        window.location.href = "productManagement.php";
    }

    function viewproducts() {
        window.location.href = "viewProducts.php";
    }

    function logout() {
        if (confirm('Are you sure you want to logout?')) {
            window.location.href = "php/logout.php";
        }
    }


    function deleteproducts() {
        window.location.href = "deleteProducts.php";
    }
</script>

</body>

</html>