<?php

session_start();

if (isset($_SESSION['username'])) {
    $email = $_SESSION['username'];
} else {
    header("Location: php/user.php"); // Redirect to the login page
}


$conn = new mysqli('localhost', 'root', '', 'agrora');

if ($conn->connect_error) {
    die('Connection Failed : ' . $conn->connect_error);
} else {
    // Fetch cart items for the logged-in user
    $stmt = $conn->prepare("SELECT cartID, productName, productPrice, productImage, quantity  FROM cart WHERE emailAddress = ?");
    $stmt->bind_param("s", $email);

    if ($stmt->execute()) {
        $result = $stmt->get_result();

        $totalPrice = 0;

        while ($row = $result->fetch_assoc()) {
            $itemPrice = $row['productPrice'] * $row['quantity'];
            $totalPrice += $itemPrice;

            echo '<tr class="tableRows">';
            echo '<td class="tableData">' . $row['productName'] . '</td>';
            echo '<td class="tableData">' . $row['productPrice'] . '</td>';
            echo '<td class="tableData" ">' . $row['quantity'] . '</td>';
            echo '<td class="tableData">' . $itemPrice . '</td>';
            echo '<td class="tableData"><img src="' . $row['productImage'] . '" alt="' . $row['productName'] . '" class="cart-product-image" /></td>';
            echo '<td class="tableHide" id="deleteButtonRow"><form method="post" action="php/removeFromCart.php">';
            echo '<input type="hidden" name="cartID" value="' . $row['cartID'] . '" />';
            echo '<input type="hidden" name="quantity" value="' . $row['quantity'] . '" />';
            echo '<button type="submit" class="deleteButton" name="removeFromCart">Delete</button></form></td>';

            echo '<td class="tableHide" id="updateButtonRow">
                        <form method="post" action="php/updateCart.php">
                            <input type="number" id="quantityBar" name="quantity" placeholder ="' . $row['quantity'] . '" min="1">
                            <input type="hidden" name="cartID" value="' . $row['cartID'] . '">
                            <input type="hidden" name="productPrice" value="' . $row['productPrice'] . '">
                            <button type="submit" class="deleteButton" name="updateQuantity">Update</button>
                        </form>
                    </td>';
            echo '</tr>';
        }

        echo '<tr class="tableRows" id="totalRow">';
        echo '<td colspan="5" id="totalCol"><strong id="totallabel">TOTAL:</strong> <span id="totalPrice"> Rs. ' . $totalPrice . ' /= </span></td>';
        echo '</tr>';

        $_SESSION['totalPrice'] = $totalPrice;
    } else {
        echo "Error fetching cart items: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>