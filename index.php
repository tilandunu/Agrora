<!DOCTYPE html>
<html lang="en">

<head>
  <link rel="stylesheet" href="styles/Main Page/mainPage.css" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link rel="stylesheet" href="src/icons/font-awesome-4.7.0/css/font-awesome.min.css" />
  <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@300&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:wght@300&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@300&display=swap" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />

  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>AGRORA</title>
</head>

<body>
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
        <button type="submit">Search</button>
      </div>
    </form>
    <ul class="nav">
      <li><a href="#"> HOME </a></li>
      <li><a href="products.php"> ALL PRODUCTS </a></li>
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
      <div>
        <button id="cartbutton" onclick="openCartModal()">
          <span class="material-symbols-outlined" id="checkoutButton">
            shopping_cart
          </span>
        </button>
      </div>
    </div>
  </div>



  <div id="adHead">
    <img src="src/images/ADS/AD 3_Green_Small.jpg" alt="Advertisement" class="ads" />
    <a href="products.php" class="adButton">SHOP NOW</a>
  </div>

  <p class="carolabel">HOT DEALS</p>

  <div id="carodiv">
    <div id="carocard">
      <?php
      $conn = new mysqli('localhost', 'root', '', 'agrora');

      if ($conn->connect_error) {
        die('Connection Failed : ' . $conn->connect_error);
      } else {
        $productNames = ['Apple', 'Avacado', 'Banana', 'Delum', 'Mango'];

        foreach ($productNames as $pName) {
          $stmt = $conn->prepare("SELECT productName, productPrice, productImage FROM inventory WHERE productName = ?");
          $stmt->bind_param("s", $pName);
          $stmt->execute();

          $result = $stmt->get_result();

          if ($result->num_rows > 0) {
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
            echo 'No product with the name "' . $pName . '" found in the database.';
          }
          $stmt->close();
        }
        $conn->close();
      }
      ?>

    </div>
  </div>
  <br />

  <div id="adHead">
    <img src="src/images/ADS/AD 1_Green_Small.jpg" alt="Advertisement" class="ads" />
    <a href="products.php" class="adButton">SHOP NOW</a>

    <br>

    <p class="carolabel">TRENDING NOW</p>

    <div id="carodiv">
      <div id="carocard">

        <?php
        $conn = new mysqli('localhost', 'root', '', 'agrora');

        if ($conn->connect_error) {
          die('Connection Failed : ' . $conn->connect_error);
        } else {
          $productNames = ['Mountain Dew', 'Redbull', 'Coca-Cola', 'Kotmale Choco Milk', 'COCA-COLA Zero'];

          foreach ($productNames as $pName) {
            $stmt = $conn->prepare("SELECT productName, productPrice, productImage FROM inventory WHERE productName = ?");
            $stmt->bind_param("s", $pName);
            $stmt->execute();

            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
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
              echo 'No product with the name "' . $pName . '" found in the database.';
            }
            $stmt->close();
          }
          $conn->close();
        }
        ?>
      </div>
    </div>
    <br />

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
          <a href="index.php"> HOME </a>
          <a href="products.php"> ALL PRODUCTS </a>
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

    <script>
      function openCartModal() {
        window.location.href = "products.php";
      }
    </script>
</body>

</html>