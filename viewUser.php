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
        <button class="selectionbuttons" onclick="viewUsers()"> VIEW USERS</button>
        <button class="selectionbuttons" onclick="deleteUsers()">DELETE USERS</button>
      </div>

      <div id="filterButtons">
        <button class="filterButton" onclick="viewCustomers()">CUSTOMERS</button>
        <button class="filterButton" onclick="viewSuppliers()">SUPPLIERS</button>
      </div>

      <div id="addproductsdiv">
        <div id="backgroundFormUser">
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

              $userType = isset($_GET['accessPermission']) ? $_GET['accessPermission'] : 'customer';

              $sql = "SELECT `userID`, `firstName`, `lastName`, `phoneNumber`, `postalAddress`, `accessPermission` FROM user WHERE 	accessPermission = ?";
              $stmt = $conn->prepare($sql);
              $stmt->bind_param("s", $userType);
              $stmt->execute();
              $result = $stmt->get_result();


              if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                  echo "<tr>";
                  echo "<td>" . $row["userID"] . "</td>";
                  echo "<td>" . $row["firstName"] . "</td>";
                  echo "<td>" . $row["lastName"] . "</td>";
                  echo "<td>" . $row["phoneNumber"] . "</td>";
                  echo "<td>" . $row["postalAddress"] . "</td>";
                  echo "<td>" . $row["accessPermission"] . "</td>";
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
  function viewUsers() {
    window.location.href = "viewUser.php";
  }

  function viewCustomers() {
    window.location.href = "viewUser.php?accessPermission=customer";
  }

  function viewSuppliers() {
    window.location.href = "viewUser.php?accessPermission=supplier";
  }

  function logout() {
    if (confirm('Are you sure you want to logout?')) {
      window.location.href = "php/logout.php";
    }
  }

  function deleteUsers() {
    window.location.href = "deleteUsers.php";
  }
</script>

</body>

</html>