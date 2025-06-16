<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="styles/Main Page/supplier.css" />
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
        <button class="productbutton" onclick="addButton()">
          ADD STOCK
        </button>
        <button class="productbutton" id="activebutton" onclick="viewButton()">
          VIEW STOCK
        </button>
      </div>
    </div>
  </div>

  <?php

  session_start();
  $conn = new mysqli('localhost', 'root', '', 'agrora');

  if ($conn->connect_error) {
    die('Connection Failed : ' . $conn->connect_error);
  } else {


    $email = $_SESSION['username'];

    $stmt = $conn->prepare("SELECT stockID, productName, productPrice , quantity FROM stock WHERE emailAddress = ?");
    $stmt->bind_param("s", $email);

    if ($stmt->execute()) {
      $result = $stmt->get_result();

      $totalPrice = 0;

      echo '<div id="cartTableContainer">';
      echo '<table id="cartTable">';
      echo '<tr class="tableRows" id="tableHeaderRow">';
      echo '<th class="tableheaders">Product Name</th>';
      echo '<th class="tableheaders">Product Price</th>';
      echo '<th class="tableheaders">Quantity</th>';
      echo '<th class="tableheaders"></th>';
      echo '<th class="tableheaders"></th>';
      echo '</tr>';

      while ($row = $result->fetch_assoc()) {
        echo '<tr class="tableRows">';
        echo '<td class="tableData">' . $row['productName'] . '</td>';
        echo '<td class="tableData">' . $row['productPrice'] . '</td>';
        echo '<td class="tableData">' . $row['quantity'] . '</td>';
        echo '<td class="tableData"><a class="buttonTable" href="php/updateStock.php?stockID=' . $row['stockID'] . '">Update</a></td>';
        echo '<td class="tableData"><a class="buttonTable" href="php/deleteStock.php?stockID=' . $row['stockID'] . '" onclick="return confirm(\'Are you sure you want to delete this item?\')">Delete</a></td>';
        echo '</tr>';

        $totalPrice += $row['productPrice'];
      }
      echo '</tr>';

      echo '</table>';

      echo '<a id="total"> TOTAL :  Rs. ' . $totalPrice . ' </a>';

      echo '</div>';
    } else {
      echo "Error fetching cart items: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
  }
  ?>

  <form method="POST" action="php/sendDataToAdmin.php" id="divAdmin">
    <input type="submit" id="admin" value="SEND STOCK TO ADMIN">
  </form>


  <script>
    function logout() {
      if (confirm('Are you sure you want to logout?')) {
        window.location.href = "php/logout.php";
      }
    }

    function addButton() {
      window.location.href = "addToStock.html";
    }

    function userbutton() {
      window.location.href = "viewUser.php";
    }
  </script>
</body>

</html>