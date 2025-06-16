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
      <a href="admin.php" class="navbuttons"><span class="material-symbols-outlined" id="navbutton1">
          arrow_back_ios_new
        </span></a>
      <div id="selectionbuttonsdiv">
        <button class="selectionbuttons" onclick="addproducts()">
          ADD PRODUCTS
        </button>
        <button class="selectionbuttons" onclick="viewproducts()">VIEW PRODUCTS</button>
        <button class="selectionbuttons" onclick="deleteproducts()">DELETE PRODUCTS</button>
        <button class="selectionbuttons" onclick="activeProducts()">ACTIVE ORDERS</button>
      </div>

      <div id="addproductsdiv">
        <form id="addproductsform" method="post" action="php/addProducts.php">
          <div id="backgroundForm">
            <div class="formcontent">
              <label class="label"> Product Name: </label>
              <input type="text" class="formInput" name="productName" required />
            </div>

            <div class="formcontent">
              <label class="label"> Slug: </label>
              <input type="text" class="formInput" name="slug" required />
            </div>

            <div class="formcontent">
              <label class="label"> Product Price: </label>
              <input type="text" class="formInput" name="productPrice" required />
            </div>

            <div class="formcontent">
              <label class="label"> Product Category: </label>
              <select name="productCategory" id="select" required>
                <option value="vegetables">Vegetables</option>
                <option value="fruits">Fruits</option>
                <option value="meats">Meats</option>
                <option value="beverages">Beverages</option>
              </select>
            </div>

            <div class="formcontent">
              <label class="label"> Product Image: </label>
              <input type="text" class="formInput" name="productImage" required />
            </div>

            <div class="formcontent">
              <label class="label"> Quantity: </label>
              <input type="text" class="formInput" name="quantity" required />
            </div>


            <div id="submitDiv">
              <input type="submit" id="submit" name="submit" />
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>

  <script>
    function logout() {
      if (confirm('Are you sure you want to logout?')) {
        window.location.href = "php/logout.php";
      }
    }

    function viewproducts() {
      window.location.href = "viewProducts.php";
    }

    function deleteproducts() {
      window.location.href = "deleteProducts.php";
    }

    function activeProducts() {
      window.location.href = "viewActiveOrders.php";
    }
  </script>
</body>

</html>