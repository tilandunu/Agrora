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
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
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
        <button class="selectionbuttons" onclick="viewproducts()"> VIEW USERS</button>
        <button class="selectionbuttons">DELETE USERS</button>
      </div>

      <div id="addproductsdiv">
        <div id="backgroundFormDel">
          <div id="viewproductsdiv">
            <table id="productTable">
              <tr id="productTitle">
                <th> USER ID </th>
                <th> FIRST NAME </th>
                <th> LAST NAME </th>
                <th> PHONE NUMBER </th>
                <th> POSTAL ADDRESS </th>
                <th> USER TYPE </th>
              </tr>

              <?php
              // Connect to the database
              $conn = new mysqli('localhost', 'root', '', 'agrora');

              if ($conn->connect_error) {
                die('Connection Failed : ' . $conn->connect_error);
              }

              // Query to fetch product data
              $sql = "SELECT `userID`,`firstName`, `lastName`, `phoneNumber`, `postalAddress`, `accessPermission`, `emailAddress` FROM user";
              $result = $conn->query($sql);

              if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                  echo "<tr>";
                  echo "<td>" . $row["userID"] . "</td>";
                  echo "<td>" . $row["firstName"] . "</td>";
                  echo "<td>" . $row["lastName"] . "</td>";
                  echo "<td>" . $row["phoneNumber"] . "</td>";
                  echo "<td>" . $row["postalAddress"] . "</td>";
                  echo "<td>" . $row["accessPermission"] . "</td>";

                  if ($row["emailAddress"] != "admin@gmail.com") {
                    echo "<td>
                        <form method='POST' action='php/deleteDataFromUsers.php'>
                            <input type='hidden' name='userID' value='" . $row["userID"] . "'>
                            <input type='submit' value='Delete'>
                        </form>
                    </td>";
                  } else {
                    echo "<td></td>";
                  }
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
  function logout() {
    if (confirm('Are you sure you want to logout?')) {
      window.location.href = "php/logout.php";
    }
  }

  function viewproducts() {
    window.location.href = "viewUser.php";
  }

</script>

</body>

</html>