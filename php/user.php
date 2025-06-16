<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

// Check if the user is logged in
if (!isset($_SESSION['loggedIn'])) {
    header("Location: ../signinpagewithEmail.html"); // Redirect to the login page if not logged in
    exit();
}

// Using constants for database connection parameters
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'agrora');

// Create a database connection
$conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

if ($conn->connect_error) {
    die('Connection Failed: ' . $conn->connect_error);
}

// Fetch user data based on the logged-in user's email (assuming 'emailAddress' is a unique identifier)
$email = $_SESSION['username'];
$stmt = $conn->prepare("SELECT * FROM user WHERE `emailAddress` = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $row = $result->fetch_assoc();
    $fName = $row['firstName'];
    $lName = $row['lastName'];
    $mNumber = $row['phoneNumber'];
    $pAddress = $row['postalAddress'];
} else {
    echo "User not found in the database.";
}

// Close prepared statement and database connection
$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="../styles/Main Page/user.css" />
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@300&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap" rel="stylesheet">
    <title>AGRORA</title>
</head>

<body>
    <div id="headertopics">
        <div id="navbar">
            <a href="javascript:history.back()" class="navbuttons"><span class="material-symbols-outlined"
                    id="navbutton1">
                    arrow_back_ios_new
                </span></a>
            <a href="../index.php" class="navbuttons"><span class="material-symbols-outlined" id="navbutton2">
                    home
                </span></a>
        </div>
        <div id="logoutdiv">
            <p id="logoutLabel">LOGOUT</p>
            <span class="material-symbols-outlined" id="logout" onclick="logout()"> logout </span>
        </div>
        <h1 id="header">Greetings!
            <?php echo $fName . ' ' . $lName; ?>
        </h1>
        <div class="buttonsdiv">
            <button id="editProfile">EDIT PROFILE</button>
        </div>
    </div>
    <div id="contentDiv">
        <div class="contentItem">
            <p class="label"> First Name : </p>
            <p class="labelcontent">
                <?php echo $fName; ?>
            </p>
        </div>

        <div class="contentItem">
            <p class="label"> Last Name : </p>
            <p class="labelcontent">
                <?php echo $lName; ?>
            </p>
        </div>

        <div class="contentItem">
            <p class="label"> Mobile Number : </p>
            <p class="labelcontent">
                <?php echo $mNumber; ?>
            </p>
        </div>

        <div class="contentItem">
            <p class="label"> Postal Address : </p>
            <p class="labelcontent">
                <?php echo $pAddress; ?>
            </p>
        </div>
    </div>

    <form method="post" action="signupedit.php" id="formDiv">
        <div class="formItem">
            <p class="label"> First Name : </p>
            <input type="text" class="formcontent" placeholder="<?php echo $fName; ?>" name="firstName">
        </div>

        <div class="formItem">
            <p class="label"> Last Name : </p>
            <input type="text" class="formcontent" placeholder="<?php echo $lName; ?>" name="lastName">
        </div>

        <div class="formItem">
            <p class="label"> Mobile Number : </p>
            <input type="tel" class="formcontent" placeholder="<?php echo $mNumber; ?>" name="phoneNumber">
        </div>

        <div class="formItem">
            <p class="label"> Postal Address : </p>
            <input type="text" class="formcontent" placeholder="<?php echo $pAddress; ?>" name="postalAddress">
        </div>

        <div class="formItem">
            <input type="submit" id="submitbutton" value="Confirm">
        </div>
    </form>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const formDiv = document.getElementById("formDiv");
            const contentDiv = document.getElementById("contentDiv");

            formDiv.style.display = "none";
            contentDiv.style.display = "block";


            const editProfileButton = document.querySelector(".buttonsdiv button:nth-child(2)");

            editProfileButton.addEventListener("click", function (event) {
                event.preventDefault();

                if (formDiv.style.display === "none") {
                    formDiv.style.display = "block";
                    contentDiv.style.display = "none";
                } else {
                    formDiv.style.display = "none";
                    contentDiv.style.display = "block";
                }
            });
        });
    </script>

    <script>
        function logout() {
            window.location.href = 'logout.php';
        }
    </script>



</body>

</html>