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
        <form method="get" action="viewProducts.php">
          <div id="searchInput">
            <input type="search" id="search" name="search_query" placeholder="SEARCH FOR PRODUCTS" />
          </div>
        </form>
        <div id="backgroundForm">
          <div id="viewproductsdiv">
            <table id="productTable">
              <tr id="productTitle">
                <th> PRODUCT ID </th>
                <th> SLUG </th>
                <th> PRODUCT NAME </th>
                <th> PRICE </th>
                <th> CATEGORY </th>
                <th> QUANTITY </th>
              </tr>

              <?php
              // Connect to the database
              $conn = new mysqli('localhost', 'root', '', 'agrora');

              if ($conn->connect_error) {
                die('Connection Failed : ' . $conn->connect_error);
              }

              $searchQuery = isset($_GET['search_query']) ? $conn->real_escape_string($_GET['search_query']) : '';

              // Query to fetch product data
              $sql = "SELECT `productNumber`,`slug`, `productName`, `productPrice`, `productCategory`, `quantity` FROM product";

              if (!empty($searchQuery)) {
                $sql .= " WHERE `productName` LIKE '%$searchQuery%'";
              }

              $result = $conn->query($sql);

              if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                  echo "<tr>";
                  echo "<td>" . $row["productNumber"] . "</td>";
                  echo "<td>" . $row["slug"] . "</td>";
                  echo "<td>" . $row["productName"] . "</td>";
                  echo "<td>" . $row["productPrice"] . "</td>";
                  echo "<td>" . $row["productCategory"] . "</td>";
                  echo "<td>" . $row["quantity"] . "</td>";
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