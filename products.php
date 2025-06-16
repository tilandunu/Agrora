<?php
session_start();

if (isset($_SESSION['username'])) {
  $email = $_SESSION['username'];
} else {
  header("Location: php/user.php"); // Redirect to the login page
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <link rel="stylesheet" href="styles/Main Page/products.css" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link rel="stylesheet" href="src/icons/font-awesome-4.7.0/css/font-awesome.min.css" />
  <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@300&display=swap" rel="stylesheet" />
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:wght@300&display=swap" rel="stylesheet" />
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300&display=swap" rel="stylesheet" />


  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>AGRORA</title>
</head>

<body>
  <script>
    function openCartModal() {
      const cartModal = document.getElementById("cartModal");
      cartModal.style.display = "block";
    }

    function closeCartModal() {
      const cartModal = document.getElementById("cartModal");
      cartModal.style.display = "none";
    }

    function goToCheckout() {
      window.location.href = "checkout.php";
    }
  </script>
  <div class="header">
    <div id="headertopics">
      <a href="index.php">

        <h1 id="topic">AGRORA</h1>
        <h3 id="subtopic">"Where fresh meets Convenience"</h3>
      </a>
    </div>
    <form method="get" action="products.php">
      <div id="searchInput">
        <input type="search" id="search" name="search_query" placeholder="SEARCH FOR PRODUCTS" />
      </div>
    </form>
    <ul class="nav">
      <li><a href="index.php"> HOME </a></li>
      <li><a href="#"> ALL PRODUCTS </a></li>
      <li><a href="privacyPolicy.html"> PRIVACY POLICY </a></li>
      <li><a href="aboutus.html"> ABOUT US </a></li>
    </ul>
    <div id="icons">
      <div id="personAddIcon">
        <a href="php/user.php" id="personAddLink">
          <span class="material-symbols-outlined">
            account_circle
          </span>
        </a>
      </div>

      <button id="cartbutton" onclick="openCartModal()">
        <span class="material-symbols-outlined" id="checkoutButton">
          shopping_cart
        </span>
      </button>
    </div>
  </div>
  </div>

  <div id="content">
    <div id="filterbar">
      <p id="filterby">FILTER BY :</p>
      <hr id="linefilter" />
      <div id="filterbuttonsdiv">

        <a href="products.php?category=vegetables"> <button class="filterbarbuttons" data-category="vegetables"
            id="btnvegetables">VEGETABLES
          </button></a>
        <a href="products.php?category=fruits"><button class="filterbarbuttons" data-category="fruits" id="btnfruits">
            FRUITS
          </button></a>
        <a href="products.php?category=meats"><button class="filterbarbuttons" data-category="meat" id="btnMeat">
            MEATS
          </button></a>
        <a href="products.php?category=beverages"><button class="filterbarbuttons" data-category="beverages"
            id="btnBeverages">
            BEVERAGES
          </button></a>
        <a href="products.php"><button class="filterbarbuttons" id="btnAllProducts">
            ALL PRODUCTS
          </button></a>
      </div>
    </div>

    <div id="productsDIV">
      <?php
      // session_start();
      
      if (isset($_SESSION['username'])) {
        $email = $_SESSION['username'];

        $conn = new mysqli('localhost', 'root', '', 'agrora');

        if ($conn->connect_error) {
          die('Connection Failed : ' . $conn->connect_error);
        } else {

          $searchQuery = isset($_GET['search_query']) ? $_GET['search_query'] : '';
          $category = isset($_GET['category']) ? $_GET['category'] : '';

          if (!empty($searchQuery)) {
            $stmt = $conn->prepare("SELECT productName, productPrice, productImage FROM inventory WHERE productName LIKE ?");
            $searchParam = "%" . $searchQuery . "%";
            $stmt->bind_param("s", $searchParam);
          } elseif (!empty($category)) {
            $stmt = $conn->prepare("SELECT productName, productPrice, productImage FROM inventory WHERE productCategory = ?");
            $stmt->bind_param("s", $category);
          } else {
            // If no search query or category, retrieve all products
            $stmt = $conn->prepare("SELECT productName, productPrice, productImage FROM inventory");
          }

          if ($stmt->execute()) {
            $result = $stmt->get_result();

            while ($row = $result->fetch_assoc()) {
              echo '<section class="card">';
              echo '<div class="row">';
              echo '<img src="' . $row['productImage'] . '" alt="' . $row['productName'] . '" class="products" />';
              echo '<div class="productName">' . $row['productName'] . '</div>';
              echo '<div class="price">Rs. ' . $row['productPrice'] . '</div>';
              echo '<div class="buttoncontainer">';
              echo '<form method="post" action="php/addToCart.php">';
              echo '<input type="hidden" name="productName" value="' . $row['productName'] . '" />';
              echo '<input type="hidden" name="productPrice" value="' . $row['productPrice'] . '" />';
              echo '<input type="hidden" name="productImage" value="' . $row['productImage'] . '" />';
              echo '<button class="addtocart" type="submit">ADD TO CART</button>';
              echo '</form>';
              echo '</div>';
              echo '</div>';
              echo '</section>';
            }
          } else {
            echo "Error retrieving products: " . $stmt->error;
          }

          $stmt->close();
          $conn->close();
        }
      } else {
        header("Location: php/user.php");
      }
      ?>
    </div>
  </div>

  <div id="footer">
    <div id="footercontent">
      <div id="footerText">
        <p id="Ftext">
          Introducing Sri Lanka's latest online supermarket, catering to your
          complete range of grocery requirements from perishables to frozen
          items and everything in the middle! Now, you have the convenience of
          placing orders for all your essential items right from your home or
          any location you prefer. Take your pick from options like immediate
          delivery, next-day service, and cost-effective choices, guaranteeing
          timely access to your necessities.
        </p>
      </div>
      <div id="footlinks">
        <p>USEFUL LINKS</p>
        <hr />
        <a href="aboutus.html"> HOME </a>
        <a href="products.html"> ALL PRODUCTS </a>
        <a href="privacyPolicy.html"> PRIVACY POLICY </a>
        <a href="aboutus.html"> ABOUT US </a>
      </div>
      <div id="contactfoot">
        <p id="contacthead">GET IN TOUCH</p>
        <hr />
        <div id="footericons">
          <i class="fa fa-facebook-official" aria-hidden="true"></i>
          <i class="fa fa-twitter" aria-hidden="true"></i>
          <i class="fa fa-instagram" aria-hidden="true"></i>
          <i class="fa fa-whatsapp" aria-hidden="true"></i>
        </div>
        <p>CONTACT US: +94711234567</p>
        <p>E-MAIL: agrora.admin@gmail.com</p>
      </div>
    </div>
    <div id="rectangle">
      <p>agroracorp©2023</p>
    </div>
  </div>

  <div class="modal-container" id="cartModal">
    <div class="modal-content">
      <h2 id="modalheader">Your Shopping Cart</h2>
      <button id="closeModalButton" onclick="closeCartModal()">X</button>
      <table id="cartTable">
        <thead>
          <tr class="tableRows">
            <th class="tableheaders">Product Name</th>
            <th class="tableheaders">Product Price</th>
            <th class="tableheaders">Quantity</th>
            <th class="tableheaders">Total Product Price</th>
            <th class="tableheaders">Product Image</th>
          </tr>
        </thead>
        <tbody>
          <?php
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
                echo '<td class="tableData" id="quantityRow">';
                echo '<td class="tableData">' . $itemPrice . '</td>';
                echo '<td class="tableData"><img src="' . $row['productImage'] . '" alt="' . $row['productName'] . '" class="cart-product-image" /></td>';
                echo '<td class="tableData" id="deleteButtonRow"><form method="post" action="php/removeFromCart.php">';
                echo '<input type="hidden" name="cartID" value="' . $row['cartID'] . '" />';
                echo '<input type="hidden" name="quantity" value="' . $row['quantity'] . '" />';
                echo '<button type="submit" class="deleteButton" name="removeFromCart">Delete</button></form></td>';

                echo '<td class="tableData" id="updateButtonRow">
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
        </tbody>
      </table>

      <button onclick="goToCheckout()" id="goToCheckoutButton">CHECKOUT > </button>
    </div>
  </div>
  </div>

</body>

</html>