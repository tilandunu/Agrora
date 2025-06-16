<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="styles/Main Page/admin.css" />
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
        <span class="material-symbols-outlined" id="logout" onclick="logout()"> logout </span>
      </div>
      <h2 id="subheader">ADMIN</h2>
      <h1 id="header">DASHBOARD</h1>
      <hr />
      <div id="buttondiv">
        <button class="productbutton" onclick="productbutton()">PRODUCT<br />MANAGEMENT</button>
        <button class="productbutton" onclick="userbutton()">USER<br />MANAGEMENT</button>
      </div>
    </div>
  </div>

  <script>
    function logout() {
      if (confirm('Are you sure you want to logout?')) {
        window.location.href = "php/logout.php";
      }
    }

    function productbutton() {
      window.location.href = 'productManagement.php';
    }

    function userbutton() {
      window.location.href = 'viewUser.php';
    }
  </script>
</body>

</html>