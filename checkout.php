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
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:wght@300&display=swap" rel="stylesheet" />
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@300&display=swap" />
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Checkout</title>
  <link rel="stylesheet" href="styles/Main Page/checkout.css" />
</head>

<body>
  <div id="navbar">
    <a href="javascript:history.back()" class="navbuttons"><span class="material-symbols-outlined" id="navbutton1">
        arrow_back_ios_new
      </span></a>
    <a href="index.php" class="navbuttons"><span class="material-symbols-outlined" id="navbutton2">
        home
      </span></a>
  </div>

  <div id="headerDiv">
    <h1 id="header">Your Order</h1>
  </div>
  <div id="pageContentDiv">
    <div>
      <div id="cartTableContainer">
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
            <?php include('php/cart_table.php'); ?>
          </tbody>
        </table>
      </div>

    </div>
    <div id="formDiv">
      <form action="php/processCheckout.php" method="POST">
        <div class="methodDiv">
          <label for="paymentMethod" class="labelForm">Payment Method:</label>
          <select name="paymentMethod" id="paymentMethod">
            <option value="cashOnDelivery">Cash on Delivery</option>
            <option value="debitCreditCard">Debit/Credit Card</option>
          </select>
        </div>

        <div id="cardInfo" style="display: none">
          <div class="contentDiv">
            <label for="cardNumber" class="labelForm">Card Number:</label>
            <input type="text" class="formInputs" name="cardNumber" id="cardNumber" />
          </div>
          <br />
          <div class="contentDiv">
            <label for="cardExpireDate" class="labelForm">Card Expiry Date:</label>
            <input type="text" class="formInputs" name="cardExpireDate" id="cardExpireDate" />
          </div>
          <br />
          <div class="contentDiv">
            <label for="cardSecurityCode" class="labelForm">Card Security Code:</label>
            <input type="text" class="formInputs" name="cardSecurityCode" id="cardSecurityCode" />
          </div>
        </div>
        <input type="submit" value="PLACE ORDER" id="orderPlaceButton" />
      </form>
    </div>
  </div>

  <script>
    const paymentMethodSelect = document.getElementById("paymentMethod");
    const cardInfo = document.getElementById("cardInfo");

    paymentMethodSelect.addEventListener("change", function () {
      if (paymentMethodSelect.value === "debitCreditCard") {
        cardInfo.style.display = "flex";
        cardInfo.style.flexDirection = "column";
      } else {
        cardInfo.style.display = "none";
      }
    });
  </script>

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
        <a href="#"> DEALS </a>
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
</body>

</html>